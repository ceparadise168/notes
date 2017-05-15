[eric_tu@localhost ~]$ git clone ssh://eric_tu@192.168.30.58/home/git/git/eric_tu.git
Cloning into 'eric_tu'...
remote: Counting objects: 3, done.
remote: Total 3 (delta 0), reused 0 (delta 0)
Receiving objects: 100% (3/3), done.


```
[eric_tu@localhost ~]$ ll
總計 8
-rw-r--r--. 1 eric_tu eric_tu  176  5月  2 22:11 bashrc
drwxrwxr-x. 3 eric_tu eric_tu   25  5月  9 01:38 eric_tu
drwxr-xr-x. 2 root    root      31  5月  2 20:05 linux_basic
-rw-r--r--. 1 root    root    3996  5月  9 01:15 ssh_backup
```


```
[eric_tu@localhost ~]$ cd eric_tu/
[eric_tu@localhost eric_tu]$ ll
總計 0
-rw-rw-r--. 1 eric_tu eric_tu 0  5月  9 01:38 1
```


```
[eric_tu@localhost eric_tu]$ gl
* 07990e9 (HEAD, origin/master, origin/HEAD, master) initial commit
```

```
[eric_tu@localhost eric_tu]$ alias
alias egrep='egrep --color=auto'
alias fgrep='fgrep --color=auto'
alias gc='git checkout'
alias gl='git log --oneline --decorate --graph --color'
alias grep='grep --color=auto'
alias gs='git status'
alias gup='git remote update -p;gl'
alias l.='ls -d .* --color=auto'
alias ll='ls -l --color=auto'
alias ls='ls --color=auto'
alias vi='vim'
alias which='alias | /usr/bin/which --tty-only --read-alias --show-dot --show-tilde'
```

```
[eric_tu@localhost eric_tu]$ touch 2
[eric_tu@localhost eric_tu]$ gs
# On branch master
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#	2
nothing added to commit but untracked files present (use "git add" to track)
```

```
[eric_tu@localhost eric_tu]$ git add 2
[eric_tu@localhost eric_tu]$ git commit
[master d38cafe] [Feature]新增測試檔案
 Committer: eric_tu <eric_tu@localhost.localdomain>
Your name and email address were configured automatically based
on your username and hostname. Please check that they are accurate.
You can suppress this message by setting them explicitly:

    git config --global user.name "Your Name"
    git config --global user.email you@example.com

After doing this, you may fix the identity used for this commit with:

    git commit --amend --reset-author

 1 file changed, 0 insertions(+), 0 deletions(-)
 create mode 100644 2
```

```
[eric_tu@localhost eric_tu]$ gl
* d38cafe (HEAD, master) [Feature]新增測試檔案
* 07990e9 (origin/master, origin/HEAD) initial commit
```

```
[eric_tu@localhost eric_tu]$ git push origin HEAD:master
Counting objects: 3, done.
Delta compression using up to 2 threads.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (2/2), 267 bytes | 0 bytes/s, done.
Total 2 (delta 0), reused 0 (delta 0)
To ssh://eric_tu@192.168.30.58/home/git/git/eric_tu.git
   07990e9..d38cafe  HEAD -> master
```

```
[eric_tu@localhost eric_tu]$ gl
* d38cafe (HEAD, origin/master, origin/HEAD, master) [Feature]新增測試檔案
* 07990e9 initial commit
```

```
[eric_tu@localhost eric_tu]$ git diff d38cafe 07990e9
diff --git a/2 b/2
deleted file mode 100644
index e69de29..0000000
```

```
[eric_tu@localhost eric_tu]$ vi 2 
[eric_tu@localhost eric_tu]$ git add -u
[eric_tu@localhost eric_tu]$ git commit
[master f127511] [Feature]檔案二新增字串
 Committer: eric_tu <eric_tu@localhost.localdomain>
Your name and email address were configured automatically based
on your username and hostname. Please check that they are accurate.
You can suppress this message by setting them explicitly:

    git config --global user.name "Your Name"
    git config --global user.email you@example.com

After doing this, you may fix the identity used for this commit with:

    git commit --amend --reset-author

 1 file changed, 1 insertion(+)
```

```
[eric_tu@localhost eric_tu]$ gl
* f127511 (HEAD, master) [Feature]檔案二新增字串
* d38cafe (origin/master, origin/HEAD) [Feature]新增測試檔案
* 07990e9 initial commit
```

在 origin 分支中 push head 到 master
```
[eric_tu@localhost eric_tu]$ git push origin HEAD:master
Counting objects: 5, done.
Delta compression using up to 2 threads.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 311 bytes | 0 bytes/s, done.
Total 3 (delta 0), reused 0 (delta 0)
To ssh://eric_tu@192.168.30.58/home/git/git/eric_tu.git
   d38cafe..f127511  HEAD -> master
```

```
[eric_tu@localhost eric_tu]$ gl
* f127511 (HEAD, origin/master, origin/HEAD, master) [Feature]檔案二新增字串
* d38cafe [Feature]新增測試檔案
* 07990e9 initial commit
```


比較head與上一個commit
```
[eric_tu@localhost eric_tu]$ git diff HEAD^
diff --git a/2 b/2
index e69de29..f5ac887 100644
--- a/2
+++ b/2
@@ -0,0 +1 @@
+test 123
[eric_tu@localhost eric_tu]$ ls
1  2
[eric_tu@localhost eric_tu]$ 
```

---

```
[eric_tu@localhost eric_tu]$ gl
* 6b0f88a (HEAD, master) [Feature] add msg_board files [Bug]
* f127511 (origin/master, origin/HEAD) [Feature]檔案二新增字串
* d38cafe [Feature]新增測試檔案
* 07990e9 initial commit
```

```
[eric_tu@localhost eric_tu]$ git push
warning: push.default is unset; its implicit value is changing in
Git 2.0 from 'matching' to 'simple'. To squelch this message
and maintain the current behavior after the default changes, use:

  git config --global push.default matching

To squelch this message and adopt the new behavior now, use:

  git config --global push.default simple

See 'git help config' and search for 'push.default' for further information.
(the 'simple' mode was introduced in Git 1.7.11. Use the similar mode
'current' instead of 'simple' if you sometimes use older versions of Git)

ssh: connect to host 192.168.30.58 port 22: Connection refused
fatal: Could not read from remote repository.

Please make sure you have the correct access rights
and the repository exists.
[eric_tu@localhost eric_tu]$ 
```


---



```
基础篇：撤销git commit或者git add文件
1. Git add 添加 多余文件
这样的错误是由于，有的时候 可能
git add . （空格+ 点） 表示当前目录所有文件，不小心就会提交其他文件
git add 如果添加了错误的文件的话

撤销操作
git status 先看一下add 中的文件 
git reset HEAD 如果后面什么都不跟的话 就是上一次add 里面的全部撤销了 
git reset HEAD XXX/XXX/XXX.Java 就是对某个文件进行撤销了

2. git commit 错误
如果不小心 弄错了 git add后 ， 又 git commit 了。 
先使用 
git log 查看节点 
commit xxxxxxxxxxxxxxxxxxxxxxxxxx 
Merge: 
Author: 
Date:

然后 
git reset commit_id

PS：还没有push也就是 repo upload 的时候

git reset commit_id （回退到上一个 提交的节点 代码还是原来你修改的） 
git reset –hard commit_id （回退到上一个commit节点， 代码也发生了改变，变成上一次的）

3.如果要是 提交了以后，可以使用 git revert
还原已经提交的修改 
此次操作之前和之后的commit和history都会保留，并且把这次撤销作为一次最新的提交 
git revert HEAD 撤销前一次 commit 
git revert HEAD^ 撤销前前一次 commit 
git revert commit-id (撤销指定的版本，撤销也会作为一次提交进行保存） 
git revert是提交一个新的版本，将需要revert的版本的内容再反向修改回去，版本会递增，不影响之前提交的内容。
```
- [ref](http://xyy601-blog.logdown.com/posts/1572725-the-basics-revocation-or-git-add-git-commit-file)



```
[eric_tu@localhost eric_tu]$ git push origin HEAD:master
Everything up-to-date
[eric_tu@localhost eric_tu]$ gl
* b21f0f0 (HEAD, origin/master, origin/HEAD, master) [Feature]add nginx.d
* 1d4068d [Feature] add nginx.d [Bug]
* 6b0f88a [Feature] add msg_board files [Bug]
* f127511 [Feature]檔案二新增字串
* d38cafe [Feature]新增測試檔案
* 07990e9 initial commit
[eric_tu@localhost eric_tu]$ qgup
-bash: qgup：命令找不到
[eric_tu@localhost eric_tu]$ gup
Fetching origin
* b21f0f0 (HEAD, origin/master, origin/HEAD, master) [Feature]add nginx.d
* 1d4068d [Feature] add nginx.d [Bug]
* 6b0f88a [Feature] add msg_board files [Bug]
* f127511 [Feature]檔案二新增字串
* d38cafe [Feature]新增測試檔案
* 07990e9 initial commit
```

---

# Git: fatal: Pathspec is in submodule
http://stackoverflow.com/questions/24472596/git-fatal-pathspec-is-in-submodule
```
Removing the directory from git and adding it again worked for me:

 git rm --cached directory
 git add directory
This works if you purposefully removed the .git directory because you wanted to add directory to your main git project. In my specific case, I had git cloned an extension and ran git add . without thinking too much. Git decided to create a submodule, which I didn't like. So I removed directory/.git and ran into Git: fatal: Pathspec is in submodule. I couldn't find out how to remove the submodule stuff. Fixed with the two lines above.
```

#colordiff

https://blog.gtwang.org/linux/colordiff-command/



# git diff --color

命令別名設定： alias
```
alias gd='git diff --color'
```


https://blog.longwin.com.tw/2009/05/git-learn-initial-command-2009/


```
[eric_tu@localhost nginx]$ git add -A
[eric_tu@localhost nginx]$ git commit
Error detected while processing /home/eric_tu/.vimrc:
line   17:
E518: Unknown option: foldenable
line   18:
E518: Unknown option: foldmethod=indent
line   19:
E518: Unknown option: foldcolumn=1
line   20:
E518: Unknown option: foldlevel=5
Press ENTER or type command to continue
[detached HEAD 603f10c] [Bug] fix format
 Committer: eric_tu <eric_tu@localhost.localdomain>
Your name and email address were configured automatically based
on your username and hostname. Please check that they are accurate.
You can suppress this message by setting them explicitly:

    git config --global user.name "Your Name"
    git config --global user.email you@example.com

After doing this, you may fix the identity used for this commit with:

    git commit --amend --reset-author

 1 file changed, 1 insertion(+), 1 deletion(-)
[eric_tu@localhost nginx]$ gl
* 603f10c (HEAD) [Bug] fix format
* fcbf7d0 (origin/master, origin/HEAD) [Bug] fix format
* 0324e8d [Bug] fix format
* e4c0666 (master) [Bug] fix url
* 6c41b19 [Bug] fix post name
* 241683e [Bug] Indent style.css
* 3f0bbfa [Bug] fix index.php
* ed12806 [Bug] fix editData.php
* cd34cbe [Bug] fix addData.php
* e3bc7f5 [Bug]remove log; rename files
* b21f0f0 [Feature]add nginx.d
* 1d4068d [Feature] add nginx.d [Bug]
* 6b0f88a [Feature] add msg_board files [Bug]
* f127511 [Feature]檔案二新增字串
* d38cafe [Feature]新增測試檔案
* 07990e9 initial commit
[eric_tu@localhost nginx]$ ls
addData.php  dbConfig.php  editData.php  index.php  indexTest.php  style.css
[eric_tu@localhost nginx]$ gs
# HEAD detached from e4c0666
nothing to commit, working directory clean
[eric_tu@localhost nginx]$ gd HEAD^
diff --git a/nginx/index.php b/nginx/index.php
index d0d0f82..ec5ae17 100644
--- a/nginx/index.php
+++ b/nginx/index.php
@@ -16,7 +16,7 @@ if (isset($_GET['delete_id'])) {
 <title>Message Board</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
 
-    <script type="text/javascript">
+<script type="text/javascript">
 function edt_id(id)
 {
     window.location.href='editData.php?edit_id='+id;
[eric_tu@localhost nginx]$ ls
addData.php  dbConfig.php  editData.php  index.php  indexTest.php  style.css
[eric_tu@localhost nginx]$ git push origin HEAD:master
Counting objects: 7, done.
Delta compression using up to 2 threads.
Compressing objects: 100% (3/3), done.
Writing objects: 100% (4/4), 334 bytes | 0 bytes/s, done.
Total 4 (delta 2), reused 0 (delta 0)
To ssh://eric_tu@192.168.30.58/home/git/git/eric_tu.git
   fcbf7d0..603f10c  HEAD -> master
[eric_tu@localhost nginx]$ cp ./* /usr/share/nginx/
.git/                                       html/                                       modules/                                    mysql57-community-release-el7-7.noarch.rpm  README.md                                   www/
[eric_tu@localhost nginx]$ cp ./* /usr/share/nginx/html/msgBoard/
[eric_tu@localhost nginx]$ 
```
