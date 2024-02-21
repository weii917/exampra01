<fieldset>
    <legend>忘記密碼</legend>
    <div>請輸入信箱以查詢密碼</div>
    <div><input type="text" name="email" id="email"></div>
    <div><span id="result"></span></div>
    <div><button onclick="forget()">尋找</button></div>
</fieldset>

<script>
    function forget() {
        $.post("./api/forget.php", {
            email: $("#email").val()
        }, (res) => {
            $("#result").html(res)
        })
    }
</script>