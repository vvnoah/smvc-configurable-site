<table>
    <?php $blocks = 0;?>
    <?php for($a=1; $a<=2; $a++): ?>
        <tr>
            <?php for($b=1; $b<=7; $b++): ?>
                <?php $blocks++; ?>
                <td>
                    <table>
                        <?php $grids = 0;?>
                        <?php for($c=1; $c<=9; $c++): ?>
                            <tr>
                                <?php for($d=1; $d<=5; $d++): ?>
                                    <?php $grids++; ?>
                                    <td>
                                        <?php echo $lottoGrid[$blocks-1][$grids-1]; ?>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>