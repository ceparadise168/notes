[Simple Backup Script ](http://broexperts.com/how-to-backup-files-and-directories-in-linux-using-tar-cron-jobs/)

# 第八章、檔案與檔案系統的壓縮,打包與備份
8.7 重點回顧

壓縮指令為透過一些運算方法去將原本的檔案進行壓縮，以減少檔案所佔用的磁碟容量。

壓縮後與壓縮前的檔案所佔用的磁碟容量比值， 就可以被稱為是『壓縮比』
壓縮的好處是可以減少磁碟容量的浪費，
在 WWW 網站也可以利用檔案壓縮的技術來進行資料的傳送，好讓網站頻寬的可利用率上升喔

壓縮檔案的副檔名大多是：『*.gz, *.bz2, *.xz, *.tar, *.tar.gz, *.tar.bz2, *.tar.xz』
常見的壓縮指令有 gzip, bzip2, xz。

壓縮率最佳的是 xz，若可以不計時間成本，建議使用 xz 進行壓縮。

tar 可以用來進行檔案打包，並可支援 gzip, bzip2, xz 的壓縮。
壓　縮：tar -Jcv -f filename.tar.xz 要被壓縮的檔案或目錄名稱
查　詢：tar -Jtv -f filename.tar.xz
解壓縮：tar -Jxv -f filename.tar.xz -C 欲解壓縮的目錄

xfsdump 指令可備份檔案系統或單一目錄
xfsdump 的備份若針對檔案系統時，可進行 0-9 的 level 差異備份！其中 level 0 為完整備份；
xfsrestore 指令可還原被 xfsdump 建置的備份檔；

要建立光碟燒錄資料時，可透過 mkisofs 指令來建置；
可透過 wodim 來寫入 CD 或 DVD 燒錄機

dd 可備份完整的 partition 或 disk ，因為 dd 可讀取磁碟的 sector 表面資料
cpio 為相當優秀的備份指令，不過必須要搭配類似 find 指令來讀入欲備份的檔名資料，方可進行備份動作。

# 第九章、vim 程式編輯器

# bash

10.1.6 指令的下達與快速編輯按鈕

我們在第四章的開始下達指令小節已經提到過在 shell 環境下的指令下達方法，如果你忘記了請回到第四章再去回憶一下！這裡不重複說明了。 鳥哥這裡僅就反斜線 (\) 來說明一下指令下達的方式囉！

範例：如果指令串太長的話，如何使用兩行來輸出？
[dmtsai@study ~]$ cp /var/spool/mail/root /etc/crontab \
> /etc/fstab /root
上面這個指令用途是將三個檔案複製到 /root 這個目錄下而已。不過，因為指令太長， 於是鳥哥就利用『 \[Enter] 』來將 [Enter] 這個按鍵『跳脫！』開來，讓 [Enter] 按鍵不再具有『開始執行』的功能！好讓指令可以繼續在下一行輸入。 需要特別留意， [Enter] 按鍵是緊接著反斜線 (\) 的，兩者中間沒有其他字元。 因為 \ 僅跳脫『緊接著的下一個字符』而已！所以，萬一我寫成： 『 \ [Enter] 』，亦即 [Enter] 與反斜線中間有一個空格時，則 \ 跳脫的是『空白鍵』而不是 [Enter] 按鍵！這個地方請再仔細的看一遍！很重要！

如果順利跳脫 [Enter] 後，下一行最前面就會主動出現 > 的符號， 你可以繼續輸入指令囉！也就是說，那個 > 是系統自動出現的，你不需要輸入。

另外，當你所需要下達的指令特別長，或者是你輸入了一串錯誤的指令時，你想要快速的將這串指令整個刪除掉，一般來說，我們都是按下刪除鍵的。 有沒有其他的快速組合鍵可以協助呢？是有的！常見的有底下這些：

組合鍵	功能與示範
[ctrl]+u/[ctrl]+k	分別是從游標處向前刪除指令串 ([ctrl]+u) 及向後刪除指令串 ([ctrl]+k)。
[ctrl]+a/[ctrl]+e	分別是讓游標移動到整個指令串的最前面 ([ctrl]+a) 或最後面 ([ctrl]+e)。
總之，當我們順利的在終端機 (tty) 上面登入後， Linux 就會依據 /etc/passwd 檔案的設定給我們一個 shell (預設是 bash)，然後我們就可以依據上面的指令下達方式來操作 shell， 之後，我們就可以透過 man 這個線上查詢來查詢指令的使用方式與參數說明， 很不錯吧！那麼我們就趕緊更進一步來操作 bash 這個好玩的東西囉！

---


底下讓鳥哥舉幾個例子來讓你試看看，就知道怎麼設定好你的變數囉！
```
範例一：設定一變數 name ，且內容為 VBird
[dmtsai@study ~]$ 12name=VBird
bash: 12name=VBird: command not found...  <==螢幕會顯示錯誤！因為不能以數字開頭！
[dmtsai@study ~]$ name = VBird            <==還是錯誤！因為有空白！
[dmtsai@study ~]$ name=VBird              <==OK 的啦！

範例二：承上題，若變數內容為 VBird's name 呢，就是變數內容含有特殊符號時：
[dmtsai@study ~]$ name=VBird's name  
# 單引號與雙引號必須要成對，在上面的設定中僅有一個單引號，因此當你按下 enter 後，
# 你還可以繼續輸入變數內容。這與我們所需要的功能不同，失敗啦！
# 記得，失敗後要復原請按下 [ctrl]-c 結束！
[dmtsai@study ~]$ name="VBird's name"    <==OK 的啦！
# 指令是由左邊向右找→，先遇到的引號先有用，因此如上所示， 單引號變成一般字元！
[dmtsai@study ~]$ name='VBird's name'    <==失敗的啦！
# 因為前兩個單引號已成對，後面就多了一個不成對的單引號了！因此也就失敗了！
[dmtsai@study ~]$ name=VBird\'s\ name     <==OK 的啦！
# 利用反斜線 (\) 跳脫特殊字元，例如單引號與空白鍵，這也是 OK 的啦！

範例三：我要在 PATH 這個變數當中『累加』:/home/dmtsai/bin 這個目錄
[dmtsai@study ~]$ PATH=$PATH:/home/dmtsai/bin
[dmtsai@study ~]$ PATH="$PATH":/home/dmtsai/bin
[dmtsai@study ~]$ PATH=${PATH}:/home/dmtsai/bin
# 上面這三種格式在 PATH 裡頭的設定都是 OK 的！但是底下的例子就不見得囉！

範例四：承範例三，我要將 name 的內容多出 "yes" 呢？
[dmtsai@study ~]$ name=$nameyes  
# 知道了吧？如果沒有雙引號，那麼變數成了啥？name 的內容是 $nameyes 這個變數！
# 呵呵！我們可沒有設定過 nameyes 這個變數吶！所以，應該是底下這樣才對！
[dmtsai@study ~]$ name="$name"yes
[dmtsai@study ~]$ name=${name}yes  <==以此例較佳！

範例五：如何讓我剛剛設定的 name=VBird 可以用在下個 shell 的程序？
[dmtsai@study ~]$ name=VBird
[dmtsai@study ~]$ bash        <==進入到所謂的子程序
[dmtsai@study ~]$ echo $name  <==子程序：再次的 echo 一下；
       <==嘿嘿！並沒有剛剛設定的內容喔！
[dmtsai@study ~]$ exit        <==子程序：離開這個子程序
[dmtsai@study ~]$ export name
[dmtsai@study ~]$ bash        <==進入到所謂的子程序
[dmtsai@study ~]$ echo $name  <==子程序：在此執行！
VBird  <==看吧！出現設定值了！
[dmtsai@study ~]$ exit        <==子程序：離開這個子程序
什麼是『子程序』呢？就是說，在我目前這個 shell 的情況下，去啟用另一個新的 shell ，新的那個 shell 就是子程序啦！在一般的狀態下，父程序的自訂變數是無法在子程序內使用的。但是透過 export 將變數變成環境變數後，就能夠在子程序底下應用了！很不賴吧！至於程序的相關概念， 我們會在第十六章程序管理當中提到的喔！
```

bash 中設定變數雙引號會將參數保留

單引號只會輸出不會有特殊符號

```bash=

[dmtsai@study ~]$ name=VBird
[dmtsai@study ~]$ echo $name
VBird
[dmtsai@study ~]$ myname="$name its me"
[dmtsai@study ~]$ echo $myname
VBird its me
[dmtsai@study ~]$ myname='$name its me'
[dmtsai@study ~]$ echo $myname
$name its me

```

```
[dmtsai@study ~]$ work="/cluster/server/work/taiwan_2015/003/"
[dmtsai@study ~]$ cd $work
```

unset取消註冊

env  環境變數
set  自訂變數

export： 自訂變數轉成環境變數

刪除變數內容
從前面
#短
##長
從後面
%短
%%長

```
不過這還是有點問題！因為 username 可能已經被設定為『空字串』了！果真如此的話，那你還可以使用底下的範例來給予 username 的內容成為 root 喔！

範例二：若 username 未設定或為空字串，則將 username 內容設定為 root
[dmtsai@study ~]$ username=""
[dmtsai@study ~]$ username=${username-root}
[dmtsai@study ~]$ echo ${username}
      <==因為 username 被設定為空字串了！所以當然還是保留為空字串！
[dmtsai@study ~]$ username=${username:-root}
[dmtsai@study ~]$ echo ${username}
root  <==加上『 : 』後若變數內容為空或者是未設定，都能夠以後面的內容替換！

```

- alias 
```

[dmtsai@study ~]$ alias rm='rm -i'
[dmtsai@study ~]$ alias lm='ls -al | more'
alias vi='vim'
```

- unalias lm 

# login & non-login shell

- login shell only read two files.

1.
```
/etc/profile: system setting .better not change.
```
2.
```
~/.bash_profile or ~/.bash_login or ~/.profile : own by users.
```


* login shell

-/etc/profile will call some files in CentOS 7.x in order.

1. /etc/profile.d/*.sh
2. /etc/locale.conf
3. /usr/share/bash-completion/completions/*
---
~/.bash_profile (login shell 才會讀)


bash 在讀完了整體環境設定的 /etc/profile 並藉此呼叫其他設定檔後，接下來則是會讀取使用者的個人設定檔。 在 login shell 的 bash 環境中，所讀取的個人偏好設定檔其實主要有三個，依序分別是：

1. ~/.bash_profile
2. ~/.bash_login
3. ~/.profile

三個讀一個即可，按照順序有就不繼續讀了。

接著觀察一下 ~/.bash_profile
```
[root@localhost home]# cat ~/.bash_profile
# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs

PATH=$PATH:$HOME/bin

export PATH
```
這個檔案內有設定 PATH 這個變數喔！而且還使用了 export 將 PATH 變成環境變數呢！ 由於 PATH 在 /etc/profile 當中已經設定過，所以在這裡就以累加的方式增加使用者家目錄下的 ~/bin/ 為額外的執行檔放置目錄。這也就是說，你可以將自己建立的執行檔放置到你自己家目錄下的 ~/bin/ 目錄啦！ 那就可以直接執行該執行檔而不需要使用絕對/相對路徑來執行該檔案。


####  source : 讀入環境設定檔的指令。

```source ~/.bashrc```    equals  ``` . ~/.bashrc```


--- 

## ~/.bashrc (non-login shell 會讀)

```bash=

[root@study ~]# cat ~/.bashrc
# .bashrc

# User specific aliases and functions
alias rm='rm -i'             <==使用者的個人設定
alias cp='cp -i'
alias mv='mv -i'

# Source global definitions
if [ -f /etc/bashrc ]; then  <==整體的環境設定
        . /etc/bashrc
fi
```
依據不同的 UID 規範出 umask 的值；
依據不同的 UID 規範出提示字元 (就是 PS1 變數)；
呼叫 /etc/profile.d/*.sh 的設定

---

## others

- /etc/man_db.conf
規範使用man的時候，man page要去哪邊找。
- ~/.bash_history
上上下下查找的歷史紀錄都在這邊，而儲存筆數則是與HISTFILESIZE有關
- ~/.bash_logout
記錄了當登出bash後，系統需要完成什麼才離開。

# 終端機環境設定: stty,set
- stty:

簡單來說就是各種快捷鍵，可以使用stty -a 來看有哪些
```bash=
[root@localhost home]# stty -a
speed 38400 baud; rows 16; columns 92; line = 0;
intr = ^C; quit = ^\; erase = ^?; kill = ^U; eof = ^D; eol = <undef>; eol2 = <undef>;
swtch = <undef>; start = ^Q; stop = ^S; susp = ^Z; rprnt = ^R; werase = ^W; lnext = ^V;
flush = ^O; min = 1; time = 0;
-parenb -parodd -cmspar cs8 -hupcl -cstopb cread -clocal -crtscts
-ignbrk -brkint -ignpar -parmrk -inpck -istrip -inlcr -igncr icrnl ixon -ixoff -iuclc -ixany
-imaxbel -iutf8
opost -olcuc -ocrnl onlcr -onocr -onlret -ofill -ofdel nl0 cr0 tab0 bs0 vt0 ff0
isig icanon iexten echo echoe echok -echonl -noflsh -xcase -tostop -echoprt echoctl echoke
[root@localhost home]# 

```

# 10.5 資料流重導向

```
ll /
ll / > ~/rootfile
ll ~/rootfile
```
該檔案 (本例中是 ~/rootfile) 若不存在，系統會自動的將他建立起來，但是
當這個檔案存在的時候，那麼系統就會先將這個檔案內容清空，然後再將資料寫入！
也就是若以 > 輸出到一個已存在的檔案中，那個檔案就會被覆蓋掉囉！

---


範例二：利用一般身份帳號搜尋 /home 底下是否有名為 .bashrc 的檔案存在
```
[dmtsai@study ~]$ find /home -name .bashrc <==身份是 dmtsai 喔！
find: '/home/arod': Permission denied    <== Standard error output
find: '/home/alex': Permission denied    <== Standard error output
/home/dmtsai/.bashrc                     <== Standard output
```
1> ：以覆蓋的方法將『正確的資料』輸出到指定的檔案或裝置上；
1>>：以累加的方法將『正確的資料』輸出到指定的檔案或裝置上；
2> ：以覆蓋的方法將『錯誤的資料』輸出到指定的檔案或裝置上；
2>>：以累加的方法將『錯誤的資料』輸出到指定的檔案或裝置上；

--- 


範例三：承範例二，將 stdout 與 stderr 分存到不同的檔案去
```
[dmtsai@study ~]$ find /home -name .bashrc > list_right 2> list_error

```
### /dev/null 垃圾桶黑洞裝置與特殊寫法

```

範例四：承範例三，將錯誤的資料丟棄，螢幕上顯示正確的資料
[dmtsai@study ~]$ find /home -name .bashrc 2> /dev/null
/home/dmtsai/.bashrc  <==只有 stdout 會顯示到螢幕上， stderr 被丟棄了
```
指儲存正確的並將錯誤資料丟棄。

## standard input ： < 與 <<

### <

```
[root@localhost home]# cat > catfile
hi
hello
[root@localhost home]# cat catfile
hi
hello
[root@localhost home]# cat > catfile < ~/.bashrc
[root@localhost home]# ll catfile ~/.bash
.bash_history  .bash_logout   .bash_profile  .bashrc        
[root@localhost home]# ll catfile ~/.bashrc 
-rw-r--r--. 1 root root 176  5月  3 09:32 catfile
-rw-r--r--. 1 root root 176 12月 29  2013 /root/.bashrc
[root@localhost home]# 

```



### <<

```
[root@localhost home]# cat > catfile << "eof"
> this is a test.
> OK now stop
> eof
[root@localhost home]# cat catfile
this is a test.
OK now stop

```
如此一來就不用使用 ^d 來結束輸入，出現關鍵字 eof 就自動離開。

## 10.5.2 命令執行的判斷依據： ; , &&, ||


# 10.6 管線命令 (pipe)

假設我們想要知道 /etc/ 底下有多少檔案，那麼可以利用 ls /etc 來查閱，不過， 因為 /etc 底下的檔案太多，導致一口氣就將螢幕塞滿了～不知道前面輸出的內容是啥？此時，我們可以透過 less 指令的協助，利用：
```
[dmtsai@study ~]$ ls -al /etc | less
```
如此一來，使用 ls 指令輸出後的內容，就能夠被 less 讀取，並且利用 less 的功能，我們就能夠前後翻動相關的資訊了！很方便是吧？

# 10.6.1 擷取命令： cut, grep
```
alias cc='clear'
```
註冊一下清除終端機的命令


```
[root@localhost /]# echo ${PATH}
/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin[root@localhost /]# 
[root@localhost /]# echo ${PATH} | cut -d ':' -f 5
/root/bin
[root@localhost /]# echo ${PATH} | cut -d ':' -f 3,5
/usr/sbin:/root/bin
[root@localhost /]# 
```
選項與參數：
-d  ：後面接分隔字元。與 -f 一起使用；
-f  ：依據 -d 的分隔字元將一段訊息分割成為數段，用 -f 取出第幾段的意思；
-c  ：以字元 (characters) 的單位取出固定字元區間；

```
[root@localhost /]# export
declare -x HISTCONTROL="ignoredups"
declare -x HISTSIZE="1000"
declare -x HOME="/root"
declare -x HOSTNAME="localhost.localdomain"
declare -x LANG="zh_TW.UTF-8"
declare -x LESSOPEN="||/usr/bin/lesspipe.sh %s"
declare -x LOGNAME="root"
declare -x LS_COLORS="rs=0:di=01;34:ln=01;36:mh=00:pi=40;33:so=01;35:do=01;35:bd=40;33;01:cd=40;33;01:or=40;31;01:mi=01;05;37;41:su=37;41:sg=30;43:ca=30;41:tw=30;42:ow=34;42:st=37;44:ex=01;32:*.tar=01;31:*.tgz=01;31:*.arc=01;31:*.arj=01;31:*.taz=01;31:*.lha=01;31:*.lz4=01;31:*.lzh=01;31:*.lzma=01;31:*.tlz=01;31:*.txz=01;31:*.tzo=01;31:*.t7z=01;31:*.zip=01;31:*.z=01;31:*.Z=01;31:*.dz=01;31:*.gz=01;31:*.lrz=01;31:*.lz=01;31:*.lzo=01;31:*.xz=01;31:*.bz2=01;31:*.bz=01;31:*.tbz=01;31:*.tbz2=01;31:*.tz=01;31:*.deb=01;31:*.rpm=01;31:*.jar=01;31:*.war=01;31:*.ear=01;31:*.sar=01;31:*.rar=01;31:*.alz=01;31:*.ace=01;31:*.zoo=01;31:*.cpio=01;31:*.7z=01;31:*.rz=01;31:*.cab=01;31:*.jpg=01;35:*.jpeg=01;35:*.gif=01;35:*.bmp=01;35:*.pbm=01;35:*.pgm=01;35:*.ppm=01;35:*.tga=01;35:*.xbm=01;35:*.xpm=01;35:*.tif=01;35:*.tiff=01;35:*.png=01;35:*.svg=01;35:*.svgz=01;35:*.mng=01;35:*.pcx=01;35:*.mov=01;35:*.mpg=01;35:*.mpeg=01;35:*.m2v=01;35:*.mkv=01;35:*.webm=01;35:*.ogm=01;35:*.mp4=01;35:*.m4v=01;35:*.mp4v=01;35:*.vob=01;35:*.qt=01;35:*.nuv=01;35:*.wmv=01;35:*.asf=01;35:*.rm=01;35:*.rmvb=01;35:*.flc=01;35:*.avi=01;35:*.fli=01;35:*.flv=01;35:*.gl=01;35:*.dl=01;35:*.xcf=01;35:*.xwd=01;35:*.yuv=01;35:*.cgm=01;35:*.emf=01;35:*.axv=01;35:*.anx=01;35:*.ogv=01;35:*.ogx=01;35:*.aac=01;36:*.au=01;36:*.flac=01;36:*.mid=01;36:*.midi=01;36:*.mka=01;36:*.mp3=01;36:*.mpc=01;36:*.ogg=01;36:*.ra=01;36:*.wav=01;36:*.axa=01;36:*.oga=01;36:*.spx=01;36:*.xspf=01;36:"
declare -x MAIL="/var/spool/mail/root"
declare -x OLDPWD="/home"
declare -x PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin"
declare -x PWD="/"
declare -x SELINUX_LEVEL_REQUESTED=""
declare -x SELINUX_ROLE_REQUESTED=""
declare -x SELINUX_USE_CURRENT_RANGE=""
declare -x SHELL="/bin/bash"
declare -x SHLVL="5"
declare -x SSH_CLIENT="192.168.171.1 64466 22"
declare -x SSH_CONNECTION="192.168.171.1 64466 192.168.171.128 22"
declare -x SSH_TTY="/dev/pts/0"
declare -x TERM="xterm"
declare -x USER="root"
declare -x XDG_RUNTIME_DIR="/run/user/0"
declare -x XDG_SESSION_ID="8"






[root@localhost /]# export | cut -c 12-
HISTCONTROL="ignoredups"
HISTSIZE="1000"
HOME="/root"
HOSTNAME="localhost.localdomain"
LANG="zh_TW.UTF-8"
LESSOPEN="||/usr/bin/lesspipe.sh %s"
LOGNAME="root"
LS_COLORS="rs=0:di=01;34:ln=01;36:mh=00:pi=40;33:so=01;35:do=01;35:bd=40;33;01:cd=40;33;01:or=40;31;01:mi=01;05;37;41:su=37;41:sg=30;43:ca=30;41:tw=30;42:ow=34;42:st=37;44:ex=01;32:*.tar=01;31:*.tgz=01;31:*.arc=01;31:*.arj=01;31:*.taz=01;31:*.lha=01;31:*.lz4=01;31:*.lzh=01;31:*.lzma=01;31:*.tlz=01;31:*.txz=01;31:*.tzo=01;31:*.t7z=01;31:*.zip=01;31:*.z=01;31:*.Z=01;31:*.dz=01;31:*.gz=01;31:*.lrz=01;31:*.lz=01;31:*.lzo=01;31:*.xz=01;31:*.bz2=01;31:*.bz=01;31:*.tbz=01;31:*.tbz2=01;31:*.tz=01;31:*.deb=01;31:*.rpm=01;31:*.jar=01;31:*.war=01;31:*.ear=01;31:*.sar=01;31:*.rar=01;31:*.alz=01;31:*.ace=01;31:*.zoo=01;31:*.cpio=01;31:*.7z=01;31:*.rz=01;31:*.cab=01;31:*.jpg=01;35:*.jpeg=01;35:*.gif=01;35:*.bmp=01;35:*.pbm=01;35:*.pgm=01;35:*.ppm=01;35:*.tga=01;35:*.xbm=01;35:*.xpm=01;35:*.tif=01;35:*.tiff=01;35:*.png=01;35:*.svg=01;35:*.svgz=01;35:*.mng=01;35:*.pcx=01;35:*.mov=01;35:*.mpg=01;35:*.mpeg=01;35:*.m2v=01;35:*.mkv=01;35:*.webm=01;35:*.ogm=01;35:*.mp4=01;35:*.m4v=01;35:*.mp4v=01;35:*.vob=01;35:*.qt=01;35:*.nuv=01;35:*.wmv=01;35:*.asf=01;35:*.rm=01;35:*.rmvb=01;35:*.flc=01;35:*.avi=01;35:*.fli=01;35:*.flv=01;35:*.gl=01;35:*.dl=01;35:*.xcf=01;35:*.xwd=01;35:*.yuv=01;35:*.cgm=01;35:*.emf=01;35:*.axv=01;35:*.anx=01;35:*.ogv=01;35:*.ogx=01;35:*.aac=01;36:*.au=01;36:*.flac=01;36:*.mid=01;36:*.midi=01;36:*.mka=01;36:*.mp3=01;36:*.mpc=01;36:*.ogg=01;36:*.ra=01;36:*.wav=01;36:*.axa=01;36:*.oga=01;36:*.spx=01;36:*.xspf=01;36:"
MAIL="/var/spool/mail/root"
OLDPWD="/home"
PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin"
PWD="/"
SELINUX_LEVEL_REQUESTED=""
SELINUX_ROLE_REQUESTED=""
SELINUX_USE_CURRENT_RANGE=""
SHELL="/bin/bash"
SHLVL="5"
SSH_CLIENT="192.168.171.1 64466 22"
SSH_CONNECTION="192.168.171.1 64466 192.168.171.128 22"
SSH_TTY="/dev/pts/0"
TERM="xterm"
USER="root"
XDG_RUNTIME_DIR="/run/user/0"
XDG_SESSION_ID="8"



[root@localhost /]# export | cut -c 12-20
HISTCONTR
HISTSIZE=
HOME="/ro
HOSTNAME=
LANG="zh_
LESSOPEN=
LOGNAME="
LS_COLORS
MAIL="/va
OLDPWD="/
PATH="/us
PWD="/"
SELINUX_L
SELINUX_R
SELINUX_U
SHELL="/b
SHLVL="5"
SSH_CLIEN
SSH_CONNE
SSH_TTY="
TERM="xte
USER="roo
XDG_RUNTI
XDG_SESSI


```



範例三：用 last 將顯示的登入者的資訊中，僅留下使用者大名

```
[root@localhost /]# last
root     pts/1        192.168.171.1    Wed May  3 08:09   still logged in   
root     pts/1        192.168.171.1    Wed May  3 06:48 - 08:09  (01:21)    
root     pts/1        192.168.171.1    Wed May  3 03:32 - 06:48  (03:16)    
root     pts/0        192.168.171.1    Wed May  3 03:19   still logged in   
root     pts/0        192.168.171.1    Wed May  3 03:10 - 03:19  (00:08)    
eric_tu  pts/0        192.168.171.1    Wed May  3 02:45 - 03:04  (00:18)    
eric_tu  pts/0        192.168.171.1    Wed May  3 01:05 - 02:07  (01:02)    
eric_tu  tty1                          Wed May  3 00:56   still logged in   
reboot   system boot  3.10.0-229.el7.x Wed May  3 00:56 - 10:16  (09:20)    
eric_tu  tty1                          Tue May  2 19:33 - crash  (05:22)    
reboot   system boot  3.10.0-229.el7.x Tue May  2 19:33 - 10:16  (14:43)    

wtmp begins Tue May  2 19:33:01 2017
[root@localhost /]# last | cut -d ' ' -f 1
root
root
root
root
root
eric_tu
eric_tu
eric_tu
reboot
eric_tu
reboot

wtmp
[root@localhost /]# 

```
 last 可以輸出『帳號/終端機/來源/日期時間』的資料，並且是排列整齊的。
 由輸出的結果我們可以發現第一個空白分隔的欄位代表帳號，所以使用
 
 ```last | cut -d ' ' -f 1 ``` 指令，
 
 將帳號資訊拉出來。


---


### grep
剛剛的 cut 是將一行訊息當中，取出某部分我們想要的，而 grep 則是分析一行訊息， 若當中有我們所需要的資訊，就將該行拿出來～簡單的語法是這樣的。
```
[root@localhost /]# last | grep 'root'

root     pts/1        192.168.171.1    Wed May  3 08:09   still logged in   
root     pts/1        192.168.171.1    Wed May  3 06:48 - 08:09  (01:21)    
root     pts/1        192.168.171.1    Wed May  3 03:32 - 06:48  (03:16)    
root     pts/0        192.168.171.1    Wed May  3 03:19   still logged in   
root     pts/0        192.168.171.1    Wed May  3 03:10 - 03:19  (00:08)    




[root@localhost /]# last | grep -v 'root'
eric_tu  pts/0        192.168.171.1    Wed May  3 02:45 - 03:04  (00:18)    
eric_tu  pts/0        192.168.171.1    Wed May  3 01:05 - 02:07  (01:02)    
eric_tu  tty1                          Wed May  3 00:56   still logged in   
reboot   system boot  3.10.0-229.el7.x Wed May  3 00:56 - 10:21  (09:25)    
eric_tu  tty1                          Tue May  2 19:33 - crash  (05:22)    
reboot   system boot  3.10.0-229.el7.x Tue May  2 19:33 - 10:21  (14:48)    

wtmp begins Tue May  2 19:33:01 2017
[root@localhost /]# 
```

第一段為將帳號為root的印出。


第二段為相反，將帳號非root的印出。


---

跟 CUT 組合一下，僅取第一欄

```
[root@localhost /]# last | grep 'root' | cut -d ' ' -f1
root
root
root
root
root
[root@localhost /]# 

```


範例四：取出 /etc/man_db.conf 內含 MANPATH 的那幾行

```
[root@localhost /]# grep --color=auto 'MANPATH' /etc/man_db.conf 
# MANDATORY_MANPATH			manpath_element
# MANPATH_MAP		path_element	manpath_element
# every automatically generated MANPATH includes these fields
#MANDATORY_MANPATH 			/usr/src/pvm3/man
MANDATORY_MANPATH			/usr/man
MANDATORY_MANPATH			/usr/share/man
MANDATORY_MANPATH			/usr/local/share/man
# set up PATH to MANPATH mapping
#		*PATH*        ->	*MANPATH*
MANPATH_MAP	/bin			/usr/share/man
MANPATH_MAP	/usr/bin		/usr/share/man
MANPATH_MAP	/sbin			/usr/share/man
MANPATH_MAP	/usr/sbin		/usr/share/man
MANPATH_MAP	/usr/local/bin		/usr/local/man
MANPATH_MAP	/usr/local/bin		/usr/local/share/man
MANPATH_MAP	/usr/local/sbin		/usr/local/man
MANPATH_MAP	/usr/local/sbin		/usr/local/share/man
MANPATH_MAP	/usr/X11R6/bin		/usr/X11R6/man
MANPATH_MAP	/usr/bin/X11		/usr/X11R6/man
MANPATH_MAP	/usr/games		/usr/share/man
MANPATH_MAP	/opt/bin		/opt/man
MANPATH_MAP	/opt/sbin		/opt/man
#		*MANPATH*     ->	*CATPATH*
[root@localhost /]# 
```


## 10.6.2 排序命令： sort, wc, uniq

預設以第一個資料來排序，且以文字由前往後排。

```
[root@localhost /]# cat  /etc/passwd | sort 
adm:x:3:4:adm:/var/adm:/sbin/nologin
alex:x:1002:1003::/home/alex:/bin/bash
arod:x:1003:1004::/home/arod:/bin/bash
avahi-autoipd:x:170:170:Avahi IPv4LL Stack:/var/lib/avahi-autoipd:/sbin/nologin
bin:x:1:1:bin:/bin:/sbin/nologin
daemon:x:2:2:daemon:/sbin:/sbin/nologin
dbus:x:81:81:System message bus:/:/sbin/nologin
eric_tu:x:1000:1000:eric_tu:/home/eric_tu:/bin/bash
ftp:x:14:50:FTP User:/var/ftp:/sbin/nologin
games:x:12:100:games:/usr/games:/sbin/nologin
halt:x:7:0:halt:/sbin:/sbin/halt
lp:x:4:7:lp:/var/spool/lpd:/sbin/nologin
mail:x:8:12:mail:/var/spool/mail:/sbin/nologin
nobody:x:99:99:Nobody:/:/sbin/nologin
operator:x:11:0:operator:/root:/sbin/nologin
polkitd:x:999:998:User for polkitd:/:/sbin/nologin
postfix:x:89:89::/var/spool/postfix:/sbin/nologin
root:x:0:0:root:/root:/bin/bash
shutdown:x:6:0:shutdown:/sbin:/sbin/shutdown
sshd:x:74:74:Privilege-separated SSH:/var/empty/sshd:/sbin/nologin
sync:x:5:0:sync:/sbin:/bin/sync
test_user:x:1001:1001::/home/test_user:/bin/bash
tss:x:59:59:Account used by the trousers package to sandbox the tcsd daemon:/dev/null:/sbin/nologin
[root@localhost /]# 

```

範例三：利用 last ，將輸出的資料僅取帳號，並加以排序

```
[root@localhost /]# last | cut -d ' ' -f1 | sort

eric_tu
eric_tu
eric_tu
eric_tu
reboot
reboot
root
root
root
root
root
wtmp
[root@localhost /]# 
```

### uniq : 重複資料只印一次

```
[root@localhost /]# last | cut -d ' ' -f1 | sort |uniq

eric_tu
reboot
root
wtmp
[root@localhost /]# 

```
加上登入次數

```
[root@localhost /]# last | cut -d ' ' -f1 | sort |uniq -c
      1 
      4 eric_tu
      2 reboot
      5 root
      1 wtmp

```

### wc

計算多少行，多少字，多少字元

```
[root@localhost /]# cat /etc/man_db.conf | wc
    131     723    5171
```
分別代表 行 字數 字元

---

範例二：我知道使用 last 可以輸出登入者，但是 last 最後兩行並非帳號內容，那麼請問，
        我該如何以一行指令串取得登入系統的總人次？

```
[root@localhost /]# last | grep [a-zA-Z] | grep -v 'wtmp' | grep -v 'reboot' | \
> grep -v 'unknown' | wc -l
9

```

由於 last 會輸出空白行, wtmp, unknown, reboot 等無關帳號登入的資訊，因此，我利用grep 取出非空白行，以及去除上述關鍵字那幾行，再計算行數，就能夠瞭解囉！


# 10.6.3 雙向重導向： tee

tee 會同時將資料流分送到檔案去與螢幕 (screen)；而輸出到螢幕的，其實就是 stdout ，那就可以讓下個指令繼續處理喔！

這個範例可以讓我們將 last 的輸出存一份到 last.list 檔案中；
```
[root@localhost /]# last | tee last.list | cut -d " " -f1
root
root
root
root
root
eric_tu
eric_tu
eric_tu
reboot
eric_tu
reboot

wtmp
[root@localhost /]# 
```

---

這個範例則是將 ls 的資料存一份到 ~/homefile ，同時螢幕也有輸出訊息！

```
[root@localhost /]# ls -l /home | tee ~/homefile | more
總計 16
drwx------. 2 alex      alex        79  5月  3 01:48 alex
drwx------. 2 arod      arod        79  5月  3 01:49 arod
-rw-r--r--. 1 root      root        23  5月  3 09:30 catcile
-rw-r--r--. 1 root      root        28  5月  3 09:35 catfile
drwx------. 3 eric_tu   eric_tu   4096  5月  3 03:04 eric_tu
-rw-r--r--. 1 root      root         0  5月  3 09:18 list_error
-rw-r--r--. 1 root      root        84  5月  3 09:18 list_right
drwx------. 2 test_user test_user   59  5月  2 20:01 test_user
[root@localhost /]# 

```

---

##### 要注意！ tee 後接的檔案會被覆蓋，若加上 -a 這個選項則能將訊息累加。

```
[root@localhost /]# ls -l /home | tee ~/homefile | more
總計 16
drwx------. 2 alex      alex        79  5月  3 01:48 alex
drwx------. 2 arod      arod        79  5月  3 01:49 arod
-rw-r--r--. 1 root      root        23  5月  3 09:30 catcile
-rw-r--r--. 1 root      root        28  5月  3 09:35 catfile
drwx------. 3 eric_tu   eric_tu   4096  5月  3 03:04 eric_tu
-rw-r--r--. 1 root      root         0  5月  3 09:18 list_error
-rw-r--r--. 1 root      root        84  5月  3 09:18 list_right
drwx------. 2 test_user test_user   59  5月  2 20:01 test_user
[root@localhost /]# cc
[root@localhost /]# ls -l / | tee -a ~/homefile | more
總計 40
drwx------.   2 root root   43  5月  3 04:40 backups
lrwxrwxrwx.   1 root root    7  5月  2 19:30 bin -> usr/bin
dr-xr-xr-x.   4 root root 4096  5月  2 19:33 boot
drwxr-xr-x.  20 root root 3120  5月  3 00:56 dev
drwxr-xr-x.  75 root root 8192  5月  3 08:22 etc
drwxr-xr-x.   6 root root 4096  5月  3 09:30 home
-rw-r--r--.   1 root root  885  5月  3 10:51 last.list
lrwxrwxrwx.   1 root root    7  5月  2 19:30 lib -> usr/lib
lrwxrwxrwx.   1 root root    9  5月  2 19:30 lib64 -> usr/lib64
drwxr-xr-x.   2 root root    6  6月 10  2014 media
drwxr-xr-x.   2 root root    6  6月 10  2014 mnt
drwxr-xr-x.   2 root root    6  6月 10  2014 opt
dr-xr-xr-x. 378 root root    0  5月  3 00:56 proc
dr-xr-x---.   3 root root 4096  5月  3 10:52 root
--更多--

```

---

### tr
tr 可以用來刪除一段訊息當中的文字，或者是進行文字訊息的替換！

範例一：將 last 輸出的訊息中，所有的小寫變成大寫字元：

```
[root@localhost /]# cc
[root@localhost /]# last | tr '[a-z]' '[A-Z]'
ROOT     PTS/1        192.168.171.1    WED MAY  3 08:09   STILL LOGGED IN   
ROOT     PTS/1        192.168.171.1    WED MAY  3 06:48 - 08:09  (01:21)    
ROOT     PTS/1        192.168.171.1    WED MAY  3 03:32 - 06:48  (03:16)    
ROOT     PTS/0        192.168.171.1    WED MAY  3 03:19   STILL LOGGED IN   
ROOT     PTS/0        192.168.171.1    WED MAY  3 03:10 - 03:19  (00:08)    
ERIC_TU  PTS/0        192.168.171.1    WED MAY  3 02:45 - 03:04  (00:18)    
ERIC_TU  PTS/0        192.168.171.1    WED MAY  3 01:05 - 02:07  (01:02)    
ERIC_TU  TTY1                          WED MAY  3 00:56   STILL LOGGED IN   
REBOOT   SYSTEM BOOT  3.10.0-229.EL7.X WED MAY  3 00:56 - 10:57  (10:00)    
ERIC_TU  TTY1                          TUE MAY  2 19:33 - CRASH  (05:22)    
REBOOT   SYSTEM BOOT  3.10.0-229.EL7.X TUE MAY  2 19:33 - 10:57  (15:23)    

WTMP BEGINS TUE MAY  2 19:33:01 2017
[root@localhost /]# 


```

---

範例二將所有的冒號刪除

```
[root@localhost /]# cat /etc/passwd | tr -d ':'
rootx00root/root/bin/bash
binx11bin/bin/sbin/nologin
daemonx22daemon/sbin/sbin/nologin
admx34adm/var/adm/sbin/nologin
lpx47lp/var/spool/lpd/sbin/nologin
syncx50sync/sbin/bin/sync
shutdownx60shutdown/sbin/sbin/shutdown
haltx70halt/sbin/sbin/halt
mailx812mail/var/spool/mail/sbin/nologin
operatorx110operator/root/sbin/nologin
gamesx12100games/usr/games/sbin/nologin
ftpx1450FTP User/var/ftp/sbin/nologin
nobodyx9999Nobody//sbin/nologin
avahi-autoipdx170170Avahi IPv4LL Stack/var/lib/avahi-autoipd/sbin/nologin
dbusx8181System message bus//sbin/nologin
polkitdx999998User for polkitd//sbin/nologin
tssx5959Account used by the trousers package to sandbox the tcsd daemon/dev/null/sbin/nologin
postfixx8989/var/spool/postfix/sbin/nologin
sshdx7474Privilege-separated SSH/var/empty/sshd/sbin/nologin
eric_tux10001000eric_tu/home/eric_tu/bin/bash
test_userx10011001/home/test_user/bin/bash
alexx10021003/home/alex/bin/bash
arodx10031004/home/arod/bin/bash
```


```

範例三：將 /etc/passwd 轉存成 dos 斷行到 /root/passwd 中，再將 ^M 符號刪除
[dmtsai@study ~]$ cp /etc/passwd ~/passwd && unix2dos ~/passwd
[dmtsai@study ~]$ file /etc/passwd ~/passwd
/etc/passwd:         ASCII text
/home/dmtsai/passwd: ASCII text, with CRLF line terminators  <==就是 DOS 斷行
[dmtsai@study ~]$ cat ~/passwd | tr -d '\r' > ~/passwd.linux
# 那個 \r 指的是 DOS 的斷行字元，關於更多的字符，請參考 man tr
[dmtsai@study ~]$ ll /etc/passwd ~/passwd*
-rw-r--r--. 1 root   root   2092 Jun 17 00:20 /etc/passwd
-rw-r--r--. 1 dmtsai dmtsai 2133 Jul  9 22:13 /home/dmtsai/passwd
-rw-rw-r--. 1 dmtsai dmtsai 2092 Jul  9 22:13 /home/dmtsai/passwd.linux
# 處理過後，發現檔案大小與原本的 /etc/passwd 就一致了！

```

*其實這個指令也可以寫在『正規表示法』裡頭！因為他也是由正規表示法的方式來取代資料的！ 以上面的例子來說，使用 [] 可以設定一串字呢！也常常用來取代檔案中的怪異符號！ 例如上面第三個例子當中，可以去除 DOS 檔案留下來的 ^M 這個斷行的符號！這東西相當的有用！相信處理 Linux & Windows 系統中的人們最麻煩的一件事就是這個事情啦！亦即是 DOS 底下會自動的在每行行尾加入 ^M 這個斷行符號！這個時候除了以前講過的 dos2unix 之外，我們也可以使用這個 tr 來將 ^M 去除！ ^M 可以使用 \r 來代替之！*

---

```
[root@localhost /]# cat  -A /etc/man_db.conf 
# $
#$
# This file is used by the man-db package to configure the man and cat paths.$
# It is also used to provide a manpath for those without one by examining$
# their PATH environment variable. For details see the manpath(5) man page.$
#$
# Lines beginning with `#' are comments and are ignored. Any combination of$
# tabs or spaces may be used as `whitespace' separators.$
#$
# There are three mappings allowed in this file:$
# --------------------------------------------------------$
# MANDATORY_MANPATH^I^I^Imanpath_element$
# MANPATH_MAP^I^Ipath_element^Imanpath_element$
# MANDB_MAP^I^Iglobal_manpath^I[relative_catpath]$
#---------------------------------------------------------$
# every automatically generated MANPATH includes these fields$
#$
#MANDATORY_MANPATH ^I^I^I/usr/src/pvm3/man$
#$
MANDATORY_MANPATH^I^I^I/usr/man$
MANDATORY_MANPATH^I^I^I/usr/share/man$
MANDATORY_MANPATH^I^I^I/usr/local/share/man$
#---------------------------------------------------------$
# set up PATH to MANPATH mapping$
# ie. what man tree holds man pages for what binary directory.$
#$
#^I^I*PATH*        ->^I*MANPATH*$
#$
MANPATH_MAP^I/bin^I^I^I/usr/share/man$
MANPATH_MAP^I/usr/bin^I^I/usr/share/man$
MANPATH_MAP^I/sbin^I^I^I/usr/share/man$
MANPATH_MAP^I/usr/sbin^I^I/usr/share/man$
MANPATH_MAP^I/usr/local/bin^I^I/usr/local/man$
MANPATH_MAP^I/usr/local/bin^I^I/usr/local/share/man$
MANPATH_MAP^I/usr/local/sbin^I^I/usr/local/man$
MANPATH_MAP^I/usr/local/sbin^I^I/usr/local/share/man$
MANPATH_MAP^I/usr/X11R6/bin^I^I/usr/X11R6/man$
MANPATH_MAP^I/usr/bin/X11^I^I/usr/X11R6/man$
MANPATH_MAP^I/usr/games^I^I/usr/share/man$
MANPATH_MAP^I/opt/bin^I^I/opt/man$
MANPATH_MAP^I/opt/sbin^I^I/opt/man$
#---------------------------------------------------------$
# For a manpath element to be treated as a system manpath (as most of those$
# above should normally be), it must be mentioned below. Each line may have$
# an optional extra string indicating the catpath associated with the$
# manpath. If no catpath string is used, the catpath will default to the$
# given manpath.$
#$
# You *must* provide all system manpaths, including manpaths for alternate$
# operating systems, locale specific manpaths, and combinations of both, if$
# they exist, otherwise the permissions of the user running man/mandb will$
# be used to manipulate the manual pages. Also, mandb will not initialise$
# the database cache for any manpaths not mentioned below unless explicitly$
# requested to do so.$
#$
# In a per-user configuration file, this directive only controls the$
# location of catpaths and the creation of database caches; it has no effect$
# on privileges.$
#$
# Any manpaths that are subdirectories of other manpaths must be mentioned$
# *before* the containing manpath. E.g. /usr/man/preformat must be listed$
# before /usr/man.$
#$
#^I^I*MANPATH*     ->^I*CATPATH*$
#$
MANDB_MAP^I/usr/man^I^I/var/cache/man/fsstnd$
MANDB_MAP^I/usr/share/man^I^I/var/cache/man$
MANDB_MAP^I/usr/local/man^I^I/var/cache/man/oldlocal$
MANDB_MAP^I/usr/local/share/man^I/var/cache/man/local$
MANDB_MAP^I/usr/X11R6/man^I^I/var/cache/man/X11R6$
MANDB_MAP^I/opt/man^I^I/var/cache/man/opt$
#$
#---------------------------------------------------------$
# Program definitions.  These are commented out by default as the value$
# of the definition is already the default.  To change: uncomment a$
# definition and modify it.$
#$
#DEFINE ^Ipager^Iless -s$
#DEFINE ^Icat^Icat$
#DEFINE ^Itr^Itr '\255\267\264\327' '\055\157\047\170'$
#DEFINE^I^Igrep^Igrep$
#DEFINE ^Itroff ^Igroff -mandoc$
#DEFINE ^Inroff ^Inroff -mandoc -c$
#DEFINE ^Ieqn ^Ieqn$
#DEFINE ^Ineqn^Ineqn$
#DEFINE ^Itbl ^Itbl$
#DEFINE ^Icol ^Icol$
#DEFINE ^Ivgrind ^I$
#DEFINE ^Irefer ^Irefer$
#DEFINE ^Igrap ^I$
#DEFINE ^Ipic ^Ipic -S$
#$
#DEFINE^I^Icompressor^Igzip -c7$
#---------------------------------------------------------$
# Misc definitions: same as program definitions above.$
#$
#DEFINE^I^Iwhatis_grep_flags^I^I-i$
#DEFINE^I^Iapropos_grep_flags^I^I-iEw$
#DEFINE^I^Iapropos_regex_grep_flags^I-iE$
#---------------------------------------------------------$
# Section names. Manual sections will be searched in the order listed here;$
# the default is 1, n, l, 8, 3, 0, 2, 5, 4, 9, 6, 7. Multiple SECTION$
# directives may be given for clarity, and will be concatenated together in$
# the expected way.$
# If a particular extension is not in this list (say, 1mh), it will be$
# displayed with the rest of the section it belongs to. The effect of this$
# is that you only need to explicitly list extensions if you want to force a$
# particular order. Sections with extensions should usually be adjacent to$
# their main section (e.g. "1 1mh 8 ...").$
#$
SECTION^I^I1 1p 8 2 3 3p 4 5 6 7 9 0p n l p o 1x 2x 3x 4x 5x 6x 7x 8x$
#$
#---------------------------------------------------------$
# Range of terminal widths permitted when displaying cat pages. If the$
# terminal falls outside this range, cat pages will not be created (if$
# missing) or displayed.$
#$
#MINCATWIDTH^I80$
#MAXCATWIDTH^I80$
#$
# If CATWIDTH is set to a non-zero number, cat pages will always be$
# formatted for a terminal of the given width, regardless of the width of$
# the terminal actually being used. This should generally be within the$
# range set by MINCATWIDTH and MAXCATWIDTH.$
#$
#CATWIDTH^I0$
#$
#---------------------------------------------------------$
# Flags.$
# NOCACHE keeps man from creating cat pages.$
#NOCACHE$
```

**這時會看到很多 ^I 符號，代表tab的意思**


```
[root@localhost /]# cat /etc/man_db.conf | col -x | cat -A | more
#$
#$
# This file is used by the man-db package to configure the man and cat paths.$
# It is also used to provide a manpath for those without one by examining$
# their PATH environment variable. For details see the manpath(5) man page.$
#$
# Lines beginning with `#' are comments and are ignored. Any combination of$
# tabs or spaces may be used as `whitespace' separators.$
#$
# There are three mappings allowed in this file:$
# --------------------------------------------------------$
# MANDATORY_MANPATH                     manpath_element$
# MANPATH_MAP           path_element    manpath_element$
# MANDB_MAP             global_manpath  [relative_catpath]$
#---------------------------------------------------------$
--更多--
```

可以看到代表 tab 的 ^I 已經被空白給取代了

雖然 col 有他特殊的用途，不過，很多時候，他可以用來簡單的處理將 [tab] 按鍵取代成為空白鍵！ 例如上面的例子當中，如果使用 cat -A 則 [tab] 會以 ^I 來表示。 但經過 col -x 的處理，則會將 [tab] 取代成為對等的空白鍵！

---

## join
join 看字面上的意義 (加入/參加) 就可以知道，他是在處理兩個檔案之間的資料， 而且，主要是在處理『兩個檔案當中，有 "相同資料" 的那一行，才將他加在一起』的意思。我們利用底下的簡單例子來說明：

```
[root@localhost /]# head  -n 3 etc/passwd /etc/shadow
==> etc/passwd <==
root:x:0:0:root:/root:/bin/bash
bin:x:1:1:bin:/bin:/sbin/nologin
daemon:x:2:2:daemon:/sbin:/sbin/nologin

==> /etc/shadow <==
root:$6$bLKNdeRd.kELYe1m$lYpqHWCKpNpZ8vXSxWo3Tt1FjD/G4bDsZL7ER05W5oANKK5vz7UIZliAZxdE96TfIush4GPYL33LZXketTZ/u1:17288:0:99999:7:::
bin:*:16372:0:99999:7:::
daemon:*:16372:0:99999:7:::
[root@localhost /]# 

```
可以發現兩個檔案的最左邊資料都同樣是帳號，並且以 : 分隔

利用 join 將兩行合成一列
```
[root@localhost /]# join -t ':' /etc/passwd /etc/shadow | head -n 3
root:x:0:0:root:/root:/bin/bash:$6$bLKNdeRd.kELYe1m$lYpqHWCKpNpZ8vXSxWo3Tt1FjD/G4bDsZL7ER05W5oANKK5vz7UIZliAZxdE96TfIush4GPYL33LZXketTZ/u1:17288:0:99999:7:::
bin:x:1:1:bin:/bin:/sbin/nologin:*:16372:0:99999:7:::
daemon:x:2:2:daemon:/sbin:/sbin/nologin:*:16372:0:99999:7:::
```

## paste 

join必須比對兩個檔案的資料關聯性，
而paste則是直接將兩行貼在一起，中間以TAB隔開。

```

[dmtsai@study ~]$ paste [-d] file1 file2
選項與參數：
-d  ：後面可以接分隔字元。預設是以 [tab] 來分隔的！
-   ：如果 file 部分寫成 - ，表示來自 standard input 的資料的意思。
```

範例一：用 root 身份，將 /etc/passwd 與 /etc/shadow 同一行貼在一起

```
[root@localhost ~]# paste /etc/passwd /etc/shadow
root:x:0:0:root:/root:/bin/bash	root:$6$bLKNdeRd.kELYe1m$lYpqHWCKpNpZ8vXSxWo3Tt1FjD/G4bDsZL7ER05W5oANKK5vz7UIZliAZxdE96TfIush4GPYL33LZXketTZ/u1:17288:0:99999:7:::
bin:x:1:1:bin:/bin:/sbin/nologin	bin:*:16372:0:99999:7:::
daemon:x:2:2:daemon:/sbin:/sbin/nologin	daemon:*:16372:0:99999:7:::
adm:x:3:4:adm:/var/adm:/sbin/nologin	adm:*:16372:0:99999:7:::
lp:x:4:7:lp:/var/spool/lpd:/sbin/nologin	lp:*:16372:0:99999:7:::
sync:x:5:0:sync:/sbin:/bin/sync	sync:*:16372:0:99999:7:::
shutdown:x:6:0:shutdown:/sbin:/sbin/shutdown	shutdown:*:16372:0:99999:7:::
halt:x:7:0:halt:/sbin:/sbin/halt	halt:*:16372:0:99999:7:::
mail:x:8:12:mail:/var/spool/mail:/sbin/nologin	mail:*:16372:0:99999:7:::
operator:x:11:0:operator:/root:/sbin/nologin	operator:*:16372:0:99999:7:::
games:x:12:100:games:/usr/games:/sbin/nologin	games:*:16372:0:99999:7:::
ftp:x:14:50:FTP User:/var/ftp:/sbin/nologin	ftp:*:16372:0:99999:7:::
nobody:x:99:99:Nobody:/:/sbin/nologin	nobody:*:16372:0:99999:7:::
avahi-autoipd:x:170:170:Avahi IPv4LL Stack:/var/lib/avahi-autoipd:/sbin/nologin	avahi-autoipd:!!:17288::::::
dbus:x:81:81:System message bus:/:/sbin/nologin	dbus:!!:17288::::::
polkitd:x:999:998:User for polkitd:/:/sbin/nologin	polkitd:!!:17288::::::
tss:x:59:59:Account used by the trousers package to sandbox the tcsd daemon:/dev/null:/sbin/nologin	tss:!!:17288::::::
postfix:x:89:89::/var/spool/postfix:/sbin/nologin	postfix:!!:17288::::::
sshd:x:74:74:Privilege-separated SSH:/var/empty/sshd:/sbin/nologin	sshd:!!:17288::::::
eric_tu:x:1000:1000:eric_tu:/home/eric_tu:/bin/bash	eric_tu:$6$5X7IyiP8UFeQ6uSU$ui5NSIDdw9RNiTxLqFaK0EGlgeVjfN7Hh7XjyiUw9E/TdfKWY3UGpCW7fZawKrJfT6OU8eua.4QdoFuyj/5Wh1:17288:0:99999:7:::
test_user:x:1001:1001::/home/test_user:/bin/bash	test_user:!!:17288:0:99999:7:::
alex:x:1002:1003::/home/alex:/bin/bash	alex:!!:17288:0:99999:7:::
arod:x:1003:1004::/home/arod:/bin/bash	arod:!!:17288:0:99999:7:::

```


範例二：先將 /etc/group 讀出(用 cat)，然後與範例一貼上一起！且僅取出前三行
```
[root@localhost ~]# cat /etc/group|paste /etc/passwd /etc/shadow -|head -n 3
root:x:0:0:root:/root:/bin/bash	root:$6$bLKNdeRd.kELYe1m$lYpqHWCKpNpZ8vXSxWo3Tt1FjD/G4bDsZL7ER05W5oANKK5vz7UIZliAZxdE96TfIush4GPYL33LZXketTZ/u1:17288:0:99999:7:::	root:x:0:
bin:x:1:1:bin:/bin:/sbin/nologin	bin:*:16372:0:99999:7:::	bin:x:1:
daemon:x:2:2:daemon:/sbin:/sbin/nologin	daemon:*:16372:0:99999:7:::	daemon:x:2:

```
### expand & unexpand

expand的功能是將TAB轉成空白鍵，unexpan則相反。

```

[dmtsai@study ~]$ expand [-t] file
選項與參數：
-t  ：後面可以接數字。一般來說，一個 tab 按鍵可以用 8 個空白鍵取代。
      我們也可以自行定義一個 [tab] 按鍵代表多少個字元呢！
```

範例一：將 /etc/man_db.conf 內行首為 MANPATH 的字樣就取出；僅取前三行；
```
[eric_tu@localhost root]$ grep '^MANPATH' /etc/man_db.conf | head -n 3
MANPATH_MAP	/bin			/usr/share/man
MANPATH_MAP	/usr/bin		/usr/share/man
MANPATH_MAP	/sbin			/usr/share/man

```

範例二：承上，如果我想要將所有的符號都列出來？(用 cat)
```
[eric_tu@localhost root]$ grep '^MANPATH' /etc/man_db.conf | head -n 3|cat -A
MANPATH_MAP^I/bin^I^I^I/usr/share/man$
MANPATH_MAP^I/usr/bin^I^I/usr/share/man$
MANPATH_MAP^I/sbin^I^I^I/usr/share/man$

```
範例三: 將TAB設為六個空白

```
[eric_tu@localhost /]$ grep '^MANPATH' /etc/man_db.conf | head -n 3| expand -t 6 - | cat -A
MANPATH_MAP /bin              /usr/share/man$
MANPATH_MAP /usr/bin          /usr/share/man$
MANPATH_MAP /sbin             /usr/share/man$

```

###split

拿來將分割檔案

```

[dmtsai@study ~]$ split [-bl] file PREFIX
選項與參數：
-b  ：後面可接欲分割成的檔案大小，可加單位，例如 b, k, m 等；
-l  ：以行數來進行分割。
PREFIX ：代表前置字元的意思，可作為分割檔案的前導文字。
```
範例一：我的 /etc/services 有六百多K，若想要分成 300K 一個檔案時？
```
[eric_tu@localhost tmp]$ cd /tmp/; split -b 300k /etc/services services
[eric_tu@localhost tmp]$ ll -k services*
-rw-r--r--. 1 eric_tu eric_tu 670293  5月  3 04:00 services
-rw-rw-r--. 1 eric_tu eric_tu 307200  5月  3 11:57 servicesaa
-rw-rw-r--. 1 eric_tu eric_tu 307200  5月  3 11:57 servicesab
-rw-rw-r--. 1 eric_tu eric_tu  55893  5月  3 11:57 servicesac
-rw-rw-r--. 1 eric_tu eric_tu 135489  5月  3 04:05 services.gz
-rw-rw-r--. 1 eric_tu eric_tu      0  5月  3 04:18 services.[gz
-rw-r--r--. 1 eric_tu eric_tu  99608  5月  3 04:00 services.xz

```

檔名可以隨意取!只要寫上前導文字，小檔案會以檔名後面加abc的方式建立。

---

範例二：如何將上面的三個小檔案合成一個檔案，檔名為 servicesback ? 用資料流重新導向即可。
```
[eric_tu@localhost tmp]$ cat services* >> servicesback

```

範例三:使用ls -al / 輸出的資訊中，每隔十行紀錄成一個檔案

```
[eric_tu@localhost tmp]$ ls -al / | split -l 10 - lsroot
[eric_tu@localhost tmp]$ wc -l lsroot*
  10 lsrootaa
  10 lsrootab
   4 lsrootac
  24 總計

```

### xargs

xargs 是在做什麼的呢？就以字面上的意義來看， x 是加減乘除的乘號，args 則是 arguments (參數) 的意思，所以說，這個玩意兒就是在產生某個指令的參數的意思！ xargs 可以讀入 stdin 的資料，並且以空白字元或斷行字元作為分辨，將 stdin 的資料分隔成為 arguments 。 因為是以空白字元作為分隔，所以，如果有一些檔名或者是其他意義的名詞內含有空白字元的時候， xargs 可能就會誤判了～他的用法其實也還滿簡單的！就來看一看先！

```
[eric_tu@localhost tmp]$ id root
uid=0(root) gid=0(root) groups=0(root)

[eric_tu@localhost tmp]$ id $(cut -d ':' -f 1 /etc/passwd | head -n 3)
id: 出現多餘的參數 ‘bin’
Try 'id --help' for more information.
```
雖然使用$cmd可以預先取得參數，但id只接受一個參數所以會出問題。

```
[eric_tu@localhost tmp]$ cut -d ':' -f 1 /etc/passwd | head -n 3 |  id
uid=1000(eric_tu) gid=1000(eric_tu) groups=1000(eric_tu),10(wheel) context=unconfined_u:unconfined_r:unconfined_t:s0-s0:c0.c1023

```
**因為 id 並不是管線命令，因此在上面這個指令執行後，前面的東西通通不見！只會執行 id !!!!!!!!**

```
[eric_tu@localhost tmp]$ cut -d ':' -f 1 /etc/passwd | head -n 3 | xargs  id
id: 出現多餘的參數 ‘bin’
Try 'id --help' for more information.

```
一樣的問題，一次餵兩個參數，id 只吃一個。

```
[eric_tu@localhost tmp]$ cut -d ':' -f 1 /etc/passwd | head -n 3 | xargs -n 1  id
uid=0(root) gid=0(root) groups=0(root)
uid=1(bin) gid=1(bin) groups=1(bin)
uid=2(daemon) gid=2(daemon) groups=2(daemon)

```

透過 -n 來處理，一次給一個參數，就可以成功了!!

```
[eric_tu@localhost tmp]$ cut -d ':' -f 1 /etc/passwd | head -n 3 | xargs -p -n 1  id
id root ?...y
id bin ?...uid=0(root) gid=0(root) groups=0(root)
n
id daemon ?...n
```

在指令後面加上參數 -p 則會逐一詢問是否要執行

```
[eric_tu@localhost tmp]$ cut -d ':' -f 1 /etc/passwd | xargs -e'sync' -n 1  id
uid=0(root) gid=0(root) groups=0(root)
uid=1(bin) gid=1(bin) groups=1(bin)
uid=2(daemon) gid=2(daemon) groups=2(daemon)
uid=3(adm) gid=4(adm) groups=4(adm)
uid=4(lp) gid=7(lp) groups=7(lp)
```
在指令後面加上參數 -e'sync' ，引號內是字串，代表每次給id 參數都檢查，遇到字串就停止。

---

其實，在 man xargs 裡面就有三四個小範例，您可以自行參考一下內容。 此外， xargs 真的是很好用的一個玩意兒！您真的需要好好的參詳參詳！會使用 xargs 的原因是， 很多指令其實並不支援管線命令，因此我們可以透過 xargs 來提供該指令引用 standard input 之用！舉例來說，我們使用如下的範例來說明：


範例四：找出 /usr/sbin 底下具有特殊權限的檔名，並使用 ls -l 列出詳細屬性
```
[eric_tu@localhost tmp]$ find /usr/sbin/ -perm /7000 | xargs ls -l
-rwxr-sr-x. 1 root root      11208  3月  6  2015 /usr/sbin/netreport
-rwsr-xr-x. 1 root root      11208  3月  6  2015 /usr/sbin/pam_timestamp_check
-rwxr-sr-x. 1 root postdrop 218552  6月 10  2014 /usr/sbin/postdrop
-rwxr-sr-x. 1 root postdrop 259992  6月 10  2014 /usr/sbin/postqueue
-rwsr-xr-x. 1 root root      36264  3月  6  2015 /usr/sbin/unix_chkpwd
-rwsr-xr-x. 1 root root      11272  3月  6  2015 /usr/sbin/usernetctl
```

使用 $(cmd) 一樣可以

```
[eric_tu@localhost tmp]$ ls -l $(find /usr/sbin -perm /7000)
-rwxr-sr-x. 1 root root      11208  3月  6  2015 /usr/sbin/netreport
-rwsr-xr-x. 1 root root      11208  3月  6  2015 /usr/sbin/pam_timestamp_check
-rwxr-sr-x. 1 root postdrop 218552  6月 10  2014 /usr/sbin/postdrop
-rwxr-sr-x. 1 root postdrop 259992  6月 10  2014 /usr/sbin/postqueue
-rwsr-xr-x. 1 root root      36264  3月  6  2015 /usr/sbin/unix_chkpwd
-rwsr-xr-x. 1 root root      11272  3月  6  2015 /usr/sbin/usernetctl
```

---

# - 的用途

管線命令在 bash 的連續的處理程序中是相當重要的！另外，在 log file 的分析當中也是相當重要的一環， 所以請特別留意！另外，在管線命令當中，常常會使用到前一個指令的 stdout 作為這次的 stdin ， 某些指令需要用到檔案名稱 (例如 tar) 來進行處理時，該 stdin 與 stdout 可以利用減號 "-" 來替代， 舉例來說：

```
[root@localhost tmp]# mkdir  /tmp/homeback

[root@localhost tmp]# tar -cvf - /home | tar -xvf - -C /tmp/homeback/
tar: 從成員名稱中移除前端的「/」
/home/
/home/eric_tu/
/home/eric_tu/.bash_logout
/home/eric_tu/.bash_profile
/home/eric_tu/.bashrc
/home/eric_tu/linux_basic/
/home/eric_tu/linux_basic/test
/home/eric_tu/linux_basic/test_cp
/home/eric_tu/bashrc
/home/eric_tu/.bash_history
/home/test_user/
/home/test_user/.bash_logout
/home/test_user/.bash_profile
home/
home/eric_tu/
home/eric_tu/.bash_logout
home/eric_tu/.bash_profile
home/eric_tu/.bashrc
home/eric_tu/linux_basic/
home/eric_tu/linux_basic/test
home/eric_tu/linux_basic/test_cp
home/eric_tu/bashrc
home/eric_tu/.bash_history
home/test_user/
home/test_user/.bash_logout
/home/test_user/.bashrc
/home/alex/
/home/alex/.bash_logout
/home/alex/.bash_profile
/home/alex/.bashrc
/home/alex/.bash_history
/home/arod/
/home/arod/.bash_logout
/home/arod/.bash_profile
/home/arod/.bashrc
/home/arod/.bash_history
/home/list_right
/home/list_error
/home/catfile
/home/catcile
home/test_user/.bash_profile
home/test_user/.bashrc
home/alex/
home/alex/.bash_logout
home/alex/.bash_profile
home/alex/.bashrc
home/alex/.bash_history
home/arod/
home/arod/.bash_logout
home/arod/.bash_profile
home/arod/.bashrc
home/arod/.bash_history
home/list_right
home/list_error
home/catfile
home/catcile
```
***
上面這個例子是說：『我將 /home 裡面的檔案給他打包，但打包的資料不是紀錄到檔案，而是傳送到 stdout； 經過管線後，將 tar -cvf - /home 傳送給後面的 tar -xvf - 』。後面的這個 - 則是取用前一個指令的 stdout， 因此，我們就不需要使用 filename 了！這是很常見的例子喔！注意注意！
***

# 10.7 重點回顧

由於核心在記憶體中是受保護的區塊，因此我們必須要透過『 Shell 』將我們輸入的指令與 Kernel 溝通，好讓 Kernel 可以控制硬體來正確無誤的工作。

學習 shell 的原因主要有：文字介面的 shell 在各大 distribution 都一樣；遠端管理時文字介面速度較快； shell 是管理 Linux 系統非常重要的一環，因為 Linux 內很多控制都是以 shell 撰寫的。

系統合法的 shell 均寫在 /etc/shells 檔案中；


使用者預設登入取得的 shell 記錄於 /etc/passwd 的最後一個欄位；


bash 的功能主要有：命令編修能力；命令與檔案補全功能；命令別名設定功能；工作控制、前景背景控制；程式化腳本；萬用字元

type 可以用來找到執行指令為何種類型，亦可用於與 which 相同的功能；


變數就是以一組文字或符號等，來取代一些設定或者是一串保留的資料


變數主要有環境變數與自訂變數，或稱為全域變數與區域變數


使用 env 與 export 可觀察環境變數，其中 export 可以將自訂變數轉成環境變數；


set 可以觀察目前 bash 環境下的所有變數；


$? 亦為變數，是前一個指令執行完畢後的回傳值。在 Linux 回傳值為 0 代表執行成功；


locale 可用於觀察語系資料；


可用 read 讓使用者由鍵盤輸入變數的值


ulimit 可用以限制使用者使用系統的資源情況


bash 的設定檔主要分為 login shell 與 non-login shell。login shell 主要讀取 /etc/profile 與 ~/.bash_profile， non-login shell 則僅讀取 ~/.bashrc


在使用 vim 時，若不小心按了 [ctrl]+s 則畫面會被凍結。你可以使用 [ctrl]+q 來解除凍結


萬用字元主要有： *, ?, [] 等等


資料流重導向透過 >, 2>, < 之類的符號將輸出的資訊轉到其他檔案或裝置去；


連續命令的下達可透過 ; && || 等符號來處理


管線命令的重點是：『管線命令僅會處理 standard output，對於 standard error output 會予以忽略』 『管線命令必須要能夠接受來自前一個指令的資料成為 standard input 繼續處理才行。』


本章介紹的管線命令主要有：cut, grep, sort, wc, uniq, tee, tr, col, join, paste, expand, split, xargs 等。