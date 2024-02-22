<fieldset>
    <legend>目前位置:首頁 > 問卷調查</legend>
    <table style="text-align: center;">
        <tr>
            <th width='10%'>編號</th>
            <th width='60%'>問卷題目</th>
            <th width='10%'>投票總數</th>
            <th width='10%'>結果</th>
            <th width='10%'>狀態</th>

        </tr>
        <?php

        $ques = $Que->all(['subject_id' => 0, 'sh' => 1]);
        foreach ($ques as $idx => $que) {
        ?>
            <tr>
                <td><?= $idx + 1; ?></td>
                <td><?= $que['text']; ?></td>
                <td><?= $que['vote']; ?></td>
                <td>
                    <a href="?do=result&id=<?= $que['id']; ?>">結果</a>
                </td>

                <td>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "<a href='?do=vote&id={$que['id']}'>參與投票</a>";
                    } else {
                        echo "<a>請先登入</a>";
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>

</fieldset>