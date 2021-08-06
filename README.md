# 短網址系統

# Table of Contents
- [背景知識](#背景知識)
- [安裝](#安裝)
- [如何使用](#如何使用)
    - [啟用產生短網址服務](#啟用產生短網址服務)
- [Example Readmes](#example-readmes)
- [Maintainers](#maintainers)

## 背景知識
這個專案對於每一個輸入的網址，會分配一組 KEY 來做為短網址代碼  
並且回應使用者服務主機的 domain + 短網址代碼，作為縮短後的網址  
當使用者把短網址貼到瀏覽器後，即可將連接轉至原始輸入的網址

為此，建構了一個背景服務，大量建立 KEY 值

## 安裝
透過 git clone 後，執行下列指令安裝  
```shell
composer install
```

## 如何使用

### 啟用產生短網址服務
