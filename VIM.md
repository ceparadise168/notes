
# 排版

由于在.vimrc文件中设置了
filetype plugin indent on
和
set cindent shiftwidth=4
在SecureCRT中使用鼠标复制-粘贴时，代码的自动缩进导致每一行都比上一行缩进一个tab，手工调整很麻烦，幸好发现了vim的自动排版方法：
在命令行模式下，首先使用“gg”将光标移动到文档开头，然后使用“v”切换到可视模式，再用“G”将光标移动到文档尾部（相当于全选），最后使用“=”，即可完成整个文档的自动排版。

http://blog.csdn.net/jianfyun/article/details/6594930


---

# Vim Bundle

```
sudo apt-get install git curl
```

```
git clone https://github.com/gmarik/vundle.git ~/.vim/bundle/vundle
```

```
vim ~/.vimrc
```

```
set nocompatible              " be iMproved, required
filetype off                  " required

" set the runtime path to include Vundle and initialize
set rtp+=~/.vim/bundle/vundle/
call vundle#rc()
" alternatively, pass a path where Vundle should install plugins
"let path = '~/some/path/here'
"call vundle#rc(path)

" let Vundle manage Vundle, required
Plugin 'gmarik/vundle'

" The following are examples of different formats supported.
" Keep Plugin commands between here and filetype plugin indent on.
" scripts on GitHub repos
Plugin 'tpope/vim-fugitive'
Plugin 'Lokaltog/vim-easymotion'
Plugin 'tpope/vim-rails.git'
" The sparkup vim script is in a subdirectory of this repo called vim.
" Pass the path to set the runtimepath properly.
Plugin 'rstacruz/sparkup', {'rtp': 'vim/'}
" scripts from http://vim-scripts.org/vim/scripts.html
Plugin 'L9'
Plugin 'FuzzyFinder'
" scripts not on GitHub
Plugin 'git://git.wincent.com/command-t.git'
" git repos on your local machine (i.e. when working on your own plugin)
Plugin 'file:///home/gmarik/path/to/plugin'
" ...

filetype plugin indent on     " required
" To ignore plugin indent changes, instead use:
"filetype plugin on
"
" Brief help
" :PluginList          - list configured plugins
" :PluginInstall(!)    - install (update) plugins
" :PluginSearch(!) foo - search (or refresh cache first) for foo
" :PluginClean(!)      - confirm (or auto-approve) removal of unused plugins
"
" see :h vundle for more details or wiki for FAQ
" NOTE: comments after Plugin commands are not allowed.
" Put your stuff after this line
```


https://blog.gtwang.org/linux/vundle-vim-bundle-plugin-manager/

# php-cs-fixer

```
curl http://get.sensiolabs.org/php-cs-fixer.phar -o php-cs-fixer
```

```
sudo chmod a+x php-cs-fixer
```

```
sudo mv php-cs-fixer /usr/local/bin/php-cs-fixer
```

http://blog.jaylin.me/archives/412



https://github.com/VundleVim/Vundle.vim/wiki/Examples

https://github.com/webastien/vim

---

Install

Before to install, backup your VIm configuration if any (in your home folder: .vimrc file and .vim folder).

Manual installation steps

Clone recursively this repository (recurse if to automaticaly get Vundle repository cloned too)
Copy both .vimrc file and .vim folder to your home directory
(optional) Edit .vimrc to feet your needs
Launch VIm as usual (errors could be displayed, ignore them for now: Plugins are not yet installed)
Execute :PluginInstall (cf Vundle's plugin doc)
Restart VIm and enjoy
Alternative for user not familiar with git clone

Replace the first two steps with:

Download this repository from Github
Download Vundle repository from Github
Extract them somewhere (download folder for example)
Copy download/webastien-vim/.vimrc in your home (/home/your-name/.vimrc)
Copy download/webastien-vim/.vim in your home (/home/your-name/.vim)
Copy download/Vundle.vim into your vim configuration (/home/your-name/.vim/bundle/Vundle.vim)
Install with command line

# Clone the repository (into "/tmp/webastien-vim" directory)
git clone --recursive https://github.com/webastien/vim.git /tmp/webastien-vim
# Copy .vimrc file and .vim folder in your home folder
cp /tmp/webastien-vim/.vimrc ~/.vimrc && rm -fr ~/.vim && cp -r /tmp/webastien-vim/.vim ~/.vim
# Install plugins using Vundle
vim -E -s -c "source ~/.vimrc" -c "PluginInstall" -c "qa!"

---


vim ~/.vimrc
add Plugin
:BundleInstall 

http://stackoverflow.com/questions/9607295/how-do-i-find-my-rsa-key-fingerprint

https://github.com/stephpy/vim-php-cs-fixer


# How can I make '/etc/vim/vimrc' writeable?

chmod chmod 666 /etc/vim/vimrc 


or


chown yourloginnameher /etc/vim/vimrc

https://askubuntu.com/questions/278523/how-can-i-make-etc-vim-vimrc-writeable




# vimrc great setting

https://github.com/spf13/spf13-vim

# ref

http://note.drx.tw/2008/01/vimrc-config.html

http://stackoverflow.com/questions/426963/replace-tab-with-spaces-in-vim

http://oomusou.io/php/php-psr2/

http://kaochenlong.com/2011/12/28/vim-tips/



http://www.vixual.net/blog/archives/234

重新命名 
先以:Ex 進入檔案瀏覽器
再用 R 重新命名


~/.vimrc
```

   1 set enc=utf8                                                                                                                                                                                                                                                             
   2 
   3 set nu
   4 
   5 set expandtab
   6 
   7 set tabstop=4
   8 
   9 set shiftwidth=4
  10 
  11 set hls
  12 
  13 set background=dark
  14 
  15 set scrolloff=3
  16 
  17 set foldenable
  18 set foldmethod=indent
  19 set foldcolumn=1
  20 set foldlevel=5
  21 
  22 " 高亮當前行 (水平)
  23 set cursorline
 ~                          
 ```



 # 分割視窗

 https://www.peterdavehello.org/2015/05/vim-split-window/

 http://linux.vbird.org/linux_basic/0310vi.php#vim_ws

開新水平視窗:
:new
開新垂直視窗:
:vnew

開啟檔案:
:sp [filename]
:vsp [filename]

ctrl + W (放開之後) + 上下左右 或 j k 來移動視窗

http://vimcolors.com/

http://vimawesome.com/?q=tag:php



http://softsmith.blogspot.tw/2013/03/vim-tab.html
# 讓 vim 顯示 tab 和行末的空白字元
以下是讓 vim 顯示 tab 和行末空白字元的指令：
set listchars=eol:$,tab:>.,trail:~,extends:>,precedes:<
set list


空白提示 加上變更上色 例如 color.diff and color.grep
git config --global color.ui auto

