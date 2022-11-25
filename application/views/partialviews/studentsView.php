<table>
    <?php foreach($student_data as $student){ ?>
        <tr>
            <?php foreach($student as $value){
                echo '<td>' . $value . '</td>';
            } ?>            
        </tr>
    <?php } ?>
</table>