# Paste burn

![screenshot.png](https://skywt.cn/paste/screenshot.png)

阅后即焚。
Burning after reading.

## 简介 / Introduction

安全 - 私密 - 防查表

demo：[skywt.cn/paste](https://skywt.cn/paste/)

> 之前网传腾讯相册在用户删除云端照片后，服务器中不会真正删除，而会一直留存。同样，在微信等国内即时通讯 APP 上「撤回」消息也不会真正让消息在服务器上消失。这一切都为商业公司窃取用户隐私乃至有关部门的审查提供了便利。
> 解决方案之一是将文字转移到真正可信任的服务器上提供，以此「确保删除」。

## 特性 / Features

- **「彻底」的删除。**
- PHP + jQuery + MySQL
- 采用 Bootstrap4 前端框架
- AJAX 提交表单
- 可使用 API 接口
- JWT 登录验证，无需存储 session
- 登陆后文字可以记录分享者

## 安装 / Installation

```
git clone https://github.com/Skywt2003/PasteBurn.git
```
将文件上传到网站目录，根据提示编辑 `config.php` 中数据库信息等；
打开 `https://yoururl.com/path/install.php`，会自动创建数据库。
创建完成后访问主页即可使用。

注意：JWT 通过明文传输，用户登录时文本和帐号密码也通过明文传输，所以建议开启全站 HTTPS 以确保安全性。

## Todo

- [x] JWT 登录
- [x] 记录文本分享时间
- [ ] 用户页面管理已分享的文字
- [ ] 自定义密码加密发送文本
- [ ] 端到端加密
- [ ] 支持链接、图片、文件的开/看/下后即焚