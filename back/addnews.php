<fieldset>
    <legend>新增文章</legend>
    <form action="./api/addnews.php" method="post">
        <div style="width:80%;margin:auto;padding-left:50px">
            <div style="display:flex;align-items:center">
                <label for="title">文章標題</label>
                <input style="width:70%" type="text" name="title" id="">
            </div>
            <div style="display:flex;align-items:center">
                <label for="type">文章分類</label>
                <select name="type" id="">
                    <option value="1">健康新知</option>
                    <option value="2">菸害防治</option>
                    <option value="3">癌症防治</option>
                    <option value="4">慢性病防治</option>
                </select>
            </div>
            <div style="display:flex;align-items:center">
                <label for="text">文章內容</label>
                <textarea name="text" id="" style="width:70%;height:200px"></textarea>
            </div>
        </div>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</fieldset>