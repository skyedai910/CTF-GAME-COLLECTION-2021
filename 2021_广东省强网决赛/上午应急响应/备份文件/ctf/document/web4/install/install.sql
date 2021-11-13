DROP TABLE IF EXISTS `opao_config`;
CREATE TABLE `opao_config` (
  `x` varchar(200) NOT NULL,
  `j` text,
  PRIMARY KEY (`x`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `opao_config` VALUES ('web_name', 'O泡易支付');
INSERT INTO `opao_config` VALUES ('admin_user', 'admin');
INSERT INTO `opao_config` VALUES ('admin_pwd', 'admin');
INSERT INTO `opao_config` VALUES ('web_qq', '2834955597');
INSERT INTO `opao_config` VALUES ('logo_url', '/assets/images/logo.png');
INSERT INTO `opao_config` VALUES ('cron_key', '123456');
INSERT INTO `opao_config` VALUES ('beian', 'O泡易支付·极致体验');
INSERT INTO `opao_config` VALUES ('wxtransfer_desc', '商户结算');
INSERT INTO `opao_config` VALUES ('payer_show_name', '商户结算');
INSERT INTO `opao_config` VALUES ('tenpay_api', '0');
INSERT INTO `opao_config` VALUES ('alipay_api', '0');
INSERT INTO `opao_config` VALUES ('ali_api_partner', '');
INSERT INTO `opao_config` VALUES ('ali_api_seller_email', '');
INSERT INTO `opao_config` VALUES ('ali_api_key', '');
INSERT INTO `opao_config` VALUES ('ali_epay_api_url', 'http://pay.ccxyu.cn/');
INSERT INTO `opao_config` VALUES ('ali_epay_api_id', '');
INSERT INTO `opao_config` VALUES ('ali_epay_api_key', '');
INSERT INTO `opao_config` VALUES ('alipay_appid', '');
INSERT INTO `opao_config` VALUES ('alipayrsaPublicKey', '');
INSERT INTO `opao_config` VALUES ('ali_close_info', '支付宝通道暂时维护');
INSERT INTO `opao_config` VALUES ('wx_close_info', '微信通道暂时维护');
INSERT INTO `opao_config` VALUES ('ten_close_info', '财付通通道暂时维护');
INSERT INTO `opao_config` VALUES ('qq_close_info', 'QQ钱包通道暂时维护');
INSERT INTO `opao_config` VALUES ('qqbz', 'O泡易支付QQ自动结算');
INSERT INTO `opao_config` VALUES ('wxbz', 'O泡易支付微信自动结算');
INSERT INTO `opao_config` VALUES ('alibz', 'O泡易支付支付宝自动结算');
INSERT INTO `opao_config` VALUES ('tenbz', 'O泡易支付财付通自动结算');
INSERT INTO `opao_config` VALUES ('local_domain', '');
INSERT INTO `opao_config` VALUES ('qqrate', '97');
INSERT INTO `opao_config` VALUES ('alirate', '97');
INSERT INTO `opao_config` VALUES ('wxrate', '97');
INSERT INTO `opao_config` VALUES ('tenrate', '97');
INSERT INTO `opao_config` VALUES ('settle_money', '10');
INSERT INTO `opao_config` VALUES ('settle_rate', '0.005');
INSERT INTO `opao_config` VALUES ('usermb_ys', 'success');
INSERT INTO `opao_config` VALUES ('adminmb_ys', 'success');
INSERT INTO `opao_config` VALUES ('sdtx_money_min', '1');
INSERT INTO `opao_config` VALUES ('settle_fee_min', '0.5');
INSERT INTO `opao_config` VALUES ('settle_fee_max', '10');
INSERT INTO `opao_config` VALUES ('settle_open', '0');
INSERT INTO `opao_config` VALUES ('yq_open', '0');
INSERT INTO `opao_config` VALUES ('web_is', '0');
INSERT INTO `opao_config` VALUES ('sdk_is', '0');
INSERT INTO `opao_config` VALUES ('phb_open', '0');
INSERT INTO `opao_config` VALUES ('price', '1');
INSERT INTO `opao_config` VALUES ('qun', '欢迎使用O泡易支付，此处为首页用户中心商户交流群加群链接，管理员请修改！');
INSERT INTO `opao_config` VALUES ('sdk', '/SDK/SDK.zip');
INSERT INTO `opao_config` VALUES ('api_tenpay_id', '');
INSERT INTO `opao_config` VALUES ('api_tenpay_key', '');
INSERT INTO `opao_config` VALUES ('ten_epay_api_url', 'http://pay.xyuds.cn/');
INSERT INTO `opao_config` VALUES ('ten_epay_api_id', '');
INSERT INTO `opao_config` VALUES ('ten_epay_api_key', '');
INSERT INTO `opao_config` VALUES ('ali_app_id', '');
INSERT INTO `opao_config` VALUES ('ali_merchant_private_key', '');
INSERT INTO `opao_config` VALUES ('ali_public_key', '');
INSERT INTO `opao_config` VALUES ('quicklogin', '0');
INSERT INTO `opao_config` VALUES ('is_reg', '1');
INSERT INTO `opao_config` VALUES ('login_is', '0');
INSERT INTO `opao_config` VALUES ('is_payreg', '1');
INSERT INTO `opao_config` VALUES ('logingg', 'Use these awesome forms to login or create new account in your project for free.');
INSERT INTO `opao_config` VALUES ('reggg', 'Use these awesome forms to login or create new account in your project for free.');
INSERT INTO `opao_config` VALUES ('reg_pid', '10001');
INSERT INTO `opao_config` VALUES ('reg_price', '1');
INSERT INTO `opao_config` VALUES ('verifytype', '0');
INSERT INTO `opao_config` VALUES ('stype_1', '1');
INSERT INTO `opao_config` VALUES ('stype_2', '1');
INSERT INTO `opao_config` VALUES ('stype_3', '0');
INSERT INTO `opao_config` VALUES ('stype_4', '1');
INSERT INTO `opao_config` VALUES ('mail_cloud', '0');
INSERT INTO `opao_config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `opao_config` VALUES ('mail_port', '465');
INSERT INTO `opao_config` VALUES ('mail_name', '');
INSERT INTO `opao_config` VALUES ('sms_appkey', '123456');
INSERT INTO `opao_config` VALUES ('mail_pwd', '');
INSERT INTO `opao_config` VALUES ('mail_apiuser', '');
INSERT INTO `opao_config` VALUES ('mail_apikey', '');
INSERT INTO `opao_config` VALUES ('CAPTCHA_ID', '“极验”官网注册获取');
INSERT INTO `opao_config` VALUES ('template', 'default1');
INSERT INTO `opao_config` VALUES ('PRIVATE_KEY', '“极验”官网注册获取');
INSERT INTO `opao_config` VALUES ('rsaPrivateKey', '');
INSERT INTO `opao_config` VALUES ('wxpay_api', '0');
INSERT INTO `opao_config` VALUES ('wx_api_appid', '');
INSERT INTO `opao_config` VALUES ('wx_api_mchid', '');
INSERT INTO `opao_config` VALUES ('wx_api_key', '');
INSERT INTO `opao_config` VALUES ('wx_api_appsecret', '');
INSERT INTO `opao_config` VALUES ('wx_epay_api_url', 'http://pay.xyuds.cn/');
INSERT INTO `opao_config` VALUES ('wx_epay_api_id', '');
INSERT INTO `opao_config` VALUES ('wx_epay_api_key', '');
INSERT INTO `opao_config` VALUES ('wx_eshanghu_sub_mch_id', '');
INSERT INTO `opao_config` VALUES ('wx_eshanghu_app_key', '');
INSERT INTO `opao_config` VALUES ('wx_eshanghu_app_secret', '');
INSERT INTO `opao_config` VALUES ('qqpay_api', '0');
INSERT INTO `opao_config` VALUES ('qq_api_mchid', '');
INSERT INTO `opao_config` VALUES ('qq_api_mchkey', '');
INSERT INTO `opao_config` VALUES ('qq_epay_api_url', 'http://pay.xyuds.cn/');
INSERT INTO `opao_config` VALUES ('qq_epay_api_id', '');
INSERT INTO `opao_config` VALUES ('qq_epay_api_key', '');
INSERT INTO `opao_config` VALUES ('goods_lj', '刷单、小视频、直播、钓鱼');
INSERT INTO `opao_config` VALUES ('goods_ljtis', 'O泡易支付提醒您：该订单商品违反了平台允售商品协议，已被安全系统拦截，停止交易。');
INSERT INTO `opao_config` VALUES ('login_offtext', 'O泡易支付系统提醒您：管理员已开启商户登录维护模式，请稍后重试！');
INSERT INTO `opao_config` VALUES ('reg_offtext', 'O泡易支付系统提醒您：管理员已关闭商户在线申请功能，请稍后重试！');
INSERT INTO `opao_config` VALUES ('web_offtext', 'O泡易支付系统正在维护中，请稍后访问！');
INSERT INTO `opao_config` VALUES ('key_no', 'O泡易支付系统提醒您：您的商户密钥验证错误，请更正后重新下单！');
INSERT INTO `opao_config` VALUES ('user_no', 'O泡易支付系统提醒您：您的商户已被封禁，已禁止登录和支付操作，有问题请联系平台客服！');
INSERT INTO `opao_config` VALUES ('qqtz', '0');
INSERT INTO `opao_config` VALUES ('mzf_id', '');
INSERT INTO `opao_config` VALUES ('mzf_key', '');
INSERT INTO `opao_config` VALUES ('h5_open', '0');
INSERT INTO `opao_config` VALUES ('cdnurl', '1');
INSERT INTO `opao_config` VALUES ('agreement', '        <p>一、总则</p>
        <p>1.1 O泡易支付的所有权和运营权归O泡易支付技术有限公司所有。</p>
        <p>1.2 用户在注册之前，应当仔细阅读本协议，并同意遵守本协议后方可成为注册用户。一旦注册成功，则用户与O泡易支付之间自动形成协议关系，用户应当受本协议的约束。用户在使用特殊的服务或产品时，应当同意接受相关协议后方能使用。</p>
        <p>1.3 本协议则可由小鱼易支付随时更新，用户应当及时关注并同意本站不承担通知义务。本站的通知、公告、声明或其它类似内容是本协议的一部分。</p>
        <p>二、服务内容</p>
        <p>2.1 O泡易支付的具体内容由本站根据实际情况提供。</p>
        <p>2.2 本站仅提供相关的网络服务，除此之外与相关网络服务有关的设备(如个人电脑、手机、及其他与接入互联网或移动网有关的装置)及所需的费用(如为接入互联网而支付的电话费及上网费、为使用移动网而支付的手机费)均应由用户自行负担。</p>
        <p>三、用户账号 </p>
        <p>3.1 经本站注册系统完成注册程序并通过身份认证的用户即成为正式用户，可以获得本站规定用户所应享有的一切权限；未经认证仅享有本站规定的部分会员权限。小鱼易支付有权对会员的权限设计进行变更。</p>
        <p>3.2 用户只能按照注册要求使用真实姓名，及身份证号注册。用户有义务保证密码和账号的安全，用户利用该密码和账号所进行的一切活动引起的任何损失或损害，由用户自行承担全部责任，本站不承担任何责任。如用户发现账号遭到未授权的使用或发生其他任何安全问题，应立即修改账号密码并妥善保管，如有必要，请通知本站。因黑客行为或用户的保管疏忽导致账号非法使用，本站不承担任何责任。</p>
        <p>四、使用规则</p>
        <p>4.1 遵守中华人民共和国相关法律法规，包括但不限于《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》、《最高人民法院关于审理涉及计算机网络著作权纠纷案件适用法律若干问题的解释(法释[2004]1号)》、《全国人大常委会关于维护互联网安全的决定》、《互联网电子公告服务管理规定》、《互联网新闻信息服务管理规定》、《互联网著作权行政保护办法》和《信息网络传播权保护条例》等有关计算机互联网规定和知识产权的法律和法规、实施办法。 </p>
        <p>4.2 用户对其自行发表、上传或传送的内容负全部责任，所有用户不得在本站任何页面发布、转载、传送含有下列内容之一的信息，否则本站有权自行处理并不通知用户：</p>
		<p>(1)违反宪法确定的基本原则的；</p>
		<p>(2)危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的；</p>
		<p>(3)损害国家荣誉和利益的；</p>
		<p>(4)煽动民族仇恨、民族歧视，破坏民族团结的；</p>
		<p>(5)破坏国家宗教政策，宣扬邪教和封建迷信的；</p>
		<p>(6)散布谣言，扰乱社会秩序，破坏社会稳定的；</p>
		<p>(7)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；</p>
		<p>(8)侮辱或者诽谤他人，侵害他人合法权益的；</p>
		<p>(9)煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的；</p>
		<p>(10)以非法民间组织名义活动的；</p>
		<p>(11)含有法律、行政法规禁止的其他内容的。</p>
		<p>(12)禁止未获授权的商户接入(如 私服、小说、影视等)。</p>
        <p>4.3 用户承诺对其发表或者上传于本站的所有信息(即属于《中华人民共和国著作权法》规定的作品，包括但不限于文字、图片、音乐、电影、表演和录音录像制品和电脑程序等)均享有完整的知识产权，或者已经得到相关权利人的合法授权；如用户违反本条规定造成本站被第三人索赔的，用户应全额补偿本站一切费用(包括但不限于各种赔偿费、诉讼代理费及为此支出的其它合理费用)； </p>
        <p>4.4 当第三方认为用户发表或者上传于本站的信息侵犯其权利，并根据《信息网络传播权保护条例》或者相关法律规定向本站发送权利通知书时，用户同意本站可以自行判断决定删除涉嫌侵权信息，除非用户提交书面证据材料排除侵权的可能性，本站将不会自动恢复上述删除的信息；</p>
        <p>(1)不得为任何非法目的而使用网络服务系统；</p>
        <p>(2)遵守所有与网络服务有关的网络协议、规定和程序； </p>
        <p>(3)不得利用本站进行任何可能对互联网的正常运转造成不利影响的行为；</p>
        <p>(4)不得利用本站进行任何不利于本站的行为。</p>
        <p>4.5 如用户在使用网络服务时违反上述任何规定，本站有权要求用户改正或直接采取一切必要的措施(包括但不限于删除用户张贴的内容、暂停或终止用户使用网络服务的权利)以减轻用户不当行为而造成的影响。</p>
        <p>五、隐私保护</p>
        <p>5.1 本站不对外公开或向第三方提供单个用户的注册资料及用户在使用网络服务时存储在本站的非公开内容，但下列情况除外：</p>
        <p>(1)事先获得用户的明确授权；</p>
        <p>(2)根据有关的法律法规要求； </p>
        <p>(3)按照相关政府主管部门的要求；</p>
        <p>(4)为维护社会公众的利益。</p>
        <p>5.2 本站可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与本站同等的保护用户隐私的责任，则本站有权将用户的注册资料等提供给该第三方。</p>
        <p>5.3 在不透露单个用户隐私资料的前提下，本站有权对整个用户数据库进行分析并对用户数据库进行商业上的利用。</p>
        <p>六、版权声明</p>
        <p>6.1 本站的文字、图片、音频、视频等版权均归O泡易支付技术有限公司享有或与作者共同享有，未经本站许可，不得任意转载。</p>
        <p>6.2 本站特有的标识、版面设计、编排方式等版权均属O泡易支付技术有限公司享有，未经本站许可，不得任意复制或转载。</p>
        <p>6.3 使用本站的任何内容均应注明“来源于O泡易支付”及署上作者姓名，按法律规定需要支付稿酬的，应当通知本站及作者及支付稿酬，并独立承担一切法律责任。</p>
        <p>6.4 本站享有所有作品用于其它用途的优先权，包括但不限于网站、电子杂志、平面出版等，但在使用前会通知作者，并按同行业的标准支付稿酬。 </p>
        <p>6.5 本站所有内容仅代表作者自己的立场和观点，与本站无关，由作者本人承担一切法律责任。 </p>
        <p>6.6 恶意转载本站内容的，本站保留将其诉诸法律的权利。 </p>
        <p>七、责任声明 </p>
        <p>7.1 用户明确同意其使用本站网络服务所存在的风险及一切后果将完全由用户本人承担，小鱼易支付对此不承担任何责任。 </p>
        <p>7.2 本站无法保证网络服务一定能满足用户的要求，也不保证网络服务的及时性、安全性、准确性。 </p>
        <p>7.3 本站不保证为方便用户而设置的外部链接的准确性和完整性，同时，对于该等外部链接指向的不由本站实际控制的任何网页上的内容，本站不承担任何责任。</p>
        <p>7.4 对于因不可抗力或本站不能控制的原因造成的网络服务中断或其它缺陷，本站不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。 </p>
        <p>7.5 对于站向用户提供的下列产品或者服务的质量缺陷本身及其引发的任何损失，本站无需承担任何责任： </p>
        <p>(1)本站向用户免费提供的各项网络服务； </p>
        <p>(2)本站向用户赠送的任何产品或者服务。 </p>
        <p>7.6 本站有权于任何时间暂时或永久修改或终止本服务(或其任何部分)，而无论其通知与否，本站对用户和任何第三人均无需承担任何责任。 </p>
        <p>八、附则</p>
        <p>8.1 本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。 </p>
        <p>8.2 如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。 </p>
        <p>8.3 本协议解释权及修订权归O泡易支付技术有限公司所有。</p>');

DROP TABLE IF EXISTS `opao_gg`;
CREATE TABLE `opao_gg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `nr` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `opao_gg` WRITE;
INSERT INTO `opao_gg` (`id`, `title`, `nr`, `url`) VALUES('1','O泡易支付系统','欢迎使用O泡易支付程序，此处为广告内容，管理员请修改，支持html！','pay.sd129..cn'),('2','O泡易支付系统','欢迎使用O泡易支付程序，此处为广告内容，管理员请修改，支持html！','pay.sd129.cn'),('3','O泡易支付系统','欢迎使用O泡易支付程序，此处为广告内容，管理员请修改，支持html！','pay.sd129.cn');
UNLOCK TABLES;

DROP TABLE IF EXISTS `opao_shjk`;
CREATE TABLE IF NOT EXISTS `opao_shjk` (
  `id` int(11) NOT NULL,
  `fl` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `addmoney` varchar(32) NOT NULL,
  `time` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `panel_log`;
CREATE TABLE `panel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `panel_user`;
CREATE TABLE `panel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `regtime` datetime DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_batch`;
CREATE TABLE `pay_batch` (
  `batch` varchar(20) NOT NULL,
  `allmoney` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_order`;
CREATE TABLE `pay_order` (
  `trade_no` varchar(64) NOT NULL,
  `out_trade_no` varchar(64) NOT NULL,
  `notify_url` varchar(200) DEFAULT NULL,
  `return_url` varchar(200) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `alipayid` varchar(32) NOT NULL,
  `username` varchar(10) NOT NULL,
  `bz` varchar(255) NOT NULL,
  `buyer` varchar(30) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `money` varchar(32) NOT NULL,
  `addmoney` varchar(32) NOT NULL,
  `rate` varchar(32) NOT NULL,
  `domain` varchar(32) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_regcode`;
CREATE TABLE `pay_regcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `trade_no` varchar(32) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_settle`;
CREATE TABLE `pay_settle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `username` varchar(10) NOT NULL,
  `account` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `transfer_status` int(1) NOT NULL DEFAULT '0',
  `transfer_result` varchar(64) DEFAULT NULL,
  `transfer_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_user`;
CREATE TABLE `pay_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `rate` varchar(8) DEFAULT NULL,
  `qqrate` varchar(8) DEFAULT NULL,
  `wxrate` varchar(8) DEFAULT NULL,
  `alirate` varchar(8) DEFAULT NULL,
  `tenrate` varchar(8) DEFAULT NULL,
  `tgrs` int(10) NOT NULL DEFAULT '0',
  `account` varchar(32) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `alipay_uid` varchar(32) DEFAULT NULL,
  `qq_uid` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL,
  `alipay` int(3) NOT NULL DEFAULT '1',
  `wxpay` int(3) NOT NULL DEFAULT '1',
  `qqpay` int(3) NOT NULL DEFAULT '1',
  `tenpay` int(3) NOT NULL DEFAULT '1',
  `settle_id` int(1) NOT NULL DEFAULT '1',
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `apply` int(1) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '推广佣金总计',
  `stype` int(1) NOT NULL DEFAULT '0' COMMENT '实时结算',  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pay_alisettle`;
CREATE TABLE `pay_alisettle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `out_trade_no` varchar(32) NOT NULL,
  `username` varchar(10) NOT NULL,
  `account` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `bz` varchar(32) NOT NULL,
  `time` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `transfer_status` int(1) NOT NULL DEFAULT '0',
  `transfer_result` varchar(64) NOT NULL,
  `transfer_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;