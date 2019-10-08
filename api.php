<?php include 'functions.php'; include 'header.php'; ?>
<div class="container maincontent">
    <h2>API：发送存储文本</h2>
    <table class="table">
        <thead>
            <tr>
                <th>API 地址</th>
                <th>请求方式</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="https://skywt.cn/paste/add.php">https://skywt.cn/paste/add.php</a>
                </td>
                <td>POST</td>
                <td>发送需要存储的文本</td>
            </tr>
        </tbody>
    </table>

    <h3>API 参数</h3>
    <table class="table">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>是否必须</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>text</td>
                <td>是</td>
                <td>需要存储的文本</td>
            </tr>
            <tr>
                <td>user</td>
                <td>否</td>
                <td>用户名</td>
            </tr>
            <tr>
                <td>pswd</td>
                <td>否</td>
                <td>MD5 加密后的密码</td>
            </tr>
        </tbody>
    </table>

    <h3>返回格式</h3>
    <p>返回为 json 格式。</p>
    <table class="table">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>类型</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>success</td>
                <td>布尔</td>
                <td>是否成功</td>
            </tr>
            <tr>
                <td>info</td>
                <td>字符串</td>
                <td>如果成功返回该文本的 id，否则返回错误信息</td>
            </tr>
        </tbody>
    </table>
    
    <h2>API：取回文本并焚毁</h2>
    <table class="table">
        <thead>
            <tr>
                <th>API 地址</th>
                <th>请求方式</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="https://skywt.cn/paste/show.php">https://skywt.cn/paste/show.php</a>
                </td>
                <td>GET</td>
                <td>取回文本并焚毁</td>
            </tr>
        </tbody>
    </table>
    <h3>API 参数</h3>

    <table class="table">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>是否必须</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>id</td>
                <td>是</td>
                <td>文本的 id</td>
            </tr>
        </tbody>
    </table>
    <h3>返回格式</h3>

    <p>返回为 json 格式。</p>
    <table class="table">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>类型</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>success</td>
                <td>布尔</td>
                <td>是否成功</td>
            </tr>
            <tr>
                <td>text</td>
                <td>字符串</td>
                <td>如果成功返回该文本，如果失败则为空</td>
            </tr>
            <tr>
                <td>user</td>
                <td>字符串</td>
                <td>如果成功并且有用户则返回用户名，否则为空</td>
            </tr>
        </tbody>
    </table>
    <p>提示：如果 <code>success</code> 为 <code>true</code> 意味着查询成功，文本会立即焚毁。再次查询将失败。</p>
</div>
<?php include 'footer.php' ?>
