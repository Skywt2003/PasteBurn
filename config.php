<?php

/* PasteBurn 配置文件 */

/* ------- 基础配置 -------
 * 配置如下内容，您的网站才可使用。
 */

// 数据库连接配置，依次为：服务器地址，用户名，密码，数据库名
 define('DB_SERVERNAME','localhost');
define('DB_USERNAME','yourUserName');
define('DB_PASSWORD','yourPassWord');
define('DB_NAME','yourDBName');

// 设置全局密钥，用于端到端加密（即将实现）和 JWT 签名
 // 强烈建议设置一个独一无二的随机字符串，越随机越好
 // 修改此项会使所有 cookie 失效，用户必须重新登录
 define('GLOBAL_KEY','79d74c8e8025ef6dd546431');

// 程序安装的根目录，记得在 url 最后加上斜杠 "/" ……
define('SITEURL','https://example.com/path/');

/* ------- 高级选项 -------
 * 一些增强的功能
  */

// 是否开启用户功能
 define('LOGIN_ENABLE',true);
// 登录用户 token 的失效时间，单位为秒
 define('MAINTAIN_TIME',86400);
// 是否允许注册（暂未建立反恶意注册的机制，建议关闭）
define('REGISTER_ENABLE',false);

// 备案号，为空则不显示备案信息
 define('ICPINFO','');

/* ------- 开发人员选项 -------
 * 仅用于调试和开发
  */

// 是否开启维护模式，开启后将无法访问整个网站（暂无用）
define('MAINTAINCE_MODE',false);
// 是否开启调试模式，开启后阅后不焚
 define('DEBUG_MODE',false);

/* ------- End -------- */
