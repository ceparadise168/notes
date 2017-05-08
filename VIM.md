
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