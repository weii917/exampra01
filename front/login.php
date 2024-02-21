<fieldset style="width:50%;margin:auto">
    <legend>會員登入</legend>
    <table style="width:100%">
        <tr>
            <td class="clo">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <button onclick="login()">登入</button>
                <button onclick="clean()">清除</button>
            </td>
            <td style="text-align: right;">
                <a href="?do=forget">忘記密碼</a> |
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>
<script>
    function login() {
        let acc = $("#acc").val();
        let pw = $("#pw").val();
        $.post("./api/chk_acc.php", {
            acc
        }, (res) => {
            if (parseInt(res) == 0) {
                alert("查無帳號")
            } else {
                $.post("./api/chk_pw.php", {
                    acc,
                    pw
                }, (res) => {
                    if (parseInt(res) == 1) {
                        if ($("#acc").val() == 'admin') {
                            location.href = 'back.php';
                        } else {
                            location.href = 'index.php';
                        }
                    }else{
                        alert("密碼錯誤")
                    }
                })
            }
        })
    }
</script>