<style type="text/css">
    table.tbl_recent_topic tr td{
        float:none;
    }
</style>

<section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full" style="padding:20px 0 20px 10px; border-left:1px solid #ccc; width:74%;">
    <h2>Latest Updated Question</h2>
    <table class="tbl_recent_topic" width="100%" border="0" style="border-collapse:collapse;">
        <?php
        $sql = $obj_class->show_question("limit 0,10");
        if ($obj_class->numRows($sql) > 0) {
            $result = "";
            while ($row = $obj_class->fetchAssoc($sql)) {
                $topictitle = $row["top_name"];
                $datequse = $row["que_create_date"];
                $questiontitile = $row["que_text"];
                $username = $row["user_fname"] . " " . $row['user_lname'];
                $countview = $row['que_count_view'];
                $image = $row["image"];
                $images = "photo/thumb/" . $row["user_id"] . "_" . $image;
                ?>
                <tr>
                    <td>
                        <h5><span class="ipsBadge ipsBadge_green"><?php echo $topictitle; ?></span>&nbsp;<a href="?page=question&top_id=<?php echo $row["que_id"]; ?>"><?php echo $obj_class->sub_string($questiontitile, 0, 60); ?></a></h5>
                        <span class="small">Started by <?php echo $username . " , " . $datequse; ?></span>
                    </td>
                    <td align="right">
                        <span class="small"><?php echo $row['count_reply']; ?> replies<br>
                            <?php echo ($countview != ''?$countview:'0'); ?> views</span>
                    </td>
                    <td align="center">
                        <img src="<?php echo $images; ?>" style="width:38px;" />
                    </td>
                    <td align="left">
                        <?php echo $username . "<br />" . date("d M Y", strtotime($datequse)); ?>
                    </td>
                </tr>
                <?php
                $result .='<tr><td><h5><span class="ipsBadge ipsBadge_green">' . $topictitle . '  </span>&nbsp;(<span class="small">'.$countview.' views</span>)</h5></td></tr>';
                $result .="<td style='padding-right:0px'><img src='$images' width='35px' height='34px' />" . "</td>";
                $result .='<td><a href="?page=question&top_id=' . $row["que_id"] . '">' . $questiontitile . '</a></td></tr>';
                $result .="<tr style='border-bottom:1px solid #ccc;'><td align='right'><span class='small'>Started by $username ,$datequse</span></td>";
                $result .="</tr>";
            }//echo $result;
        }
        ?>
    </table>
</section>