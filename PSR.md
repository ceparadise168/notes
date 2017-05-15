

The code formatting is available in VS Code through the following shortcuts:

On Windows Shift + Alt + F
On Mac Shift + Option + F
On Ubuntu Ctrl + Shift + I

http://stackoverflow.com/questions/29973357/how-do-you-format-code-in-visual-studio-code-vscode

http://idroot.net/tutorials/how-to-install-php-composer-on-centos-7/	
curl -sS https://getcomposer.org/installer | php
http://stackoverflow.com/questions/857885/formatting-php-code-within-vim/31315171


Vim :version
```
        系統 vimrc 設定檔: "/etc/vimrc"
  使用者個人 vimrc 設定檔: "$HOME/.vimrc"
    第二組個人 vimrc 檔案: "~/.vim/vimrc"
   使用者個人 exrc 設定檔: "$HOME/.exrc"
              $VIM 預設值: "/etc"
       $VIMRUNTIME 預設值: "/usr/share/vim/vim74"

```

#  ctrl+shift+v  gg   =

https://github.com/VundleVim/Vundle.vim

http://www.php-fig.org/psr/
===

# 1.Overview
- 只能使用 <?php 或 <?= 兩種tag
- 只能使用不帶 BOM 的 UTF-8 格式 ([BOM : Byte order mark](https://www.zhihu.com/question/20167122))
- 不要宣告到預設的變數
- Namespaces and classes MUST follow an “autoloading” PSR: [PSR-0, PSR-4].
- Class names MUST be declared in StudlyCaps.
- Class constants MUST be declared in all upper case with underscore separators.
- Method names MUST be declared in camelCase.



檔名: DataUpdate


變數名: sqlQuery


條件式前面空一行括號留空格:

```
...

if (...) {

}
```

開頭標籤無條件空一行:

```
<?php

...
...
...
?>
```

不同功能區塊中間空一行區隔:

```
<?php

$helloWorld
$hi

if (...) {
    ...
}
?>
```

縮排:使用4個空白


嚴格遵守PRS

參數要用逗號後空一格
function(a, b, c)
{
  
}