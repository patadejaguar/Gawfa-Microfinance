<?php
$cakeDescription = __d('title', 'GAWFA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');


        echo $this->Html->css(array('base', 'form', 'colors', 'lines', 'tables', 'flick/jquery-ui-1.8.16.custom'));

        echo $this->Html->script(array('jquery-1.7.1.min', 'jquery-ui-1.8.16.custom.min'));
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
            <div id="header">

                
                <div id="top">
                    <div class="left">
                        <?php echo "<h1>MikrhokFinance</h1>"; ?>
                    </div>
                </div>


                <div id="logo">
                    <?php // echo $this->Html->image('gawfa-rhok.png', array('alt' => 'Gawfa', 'url' => array('action' => 'index')))
                    ?>
                </div>
            </div>




            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>

            </div>
            <div id="footer">

            </div>

    </body>
</html>