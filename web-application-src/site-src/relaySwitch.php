<?php
    include'connect.php';
    if( isset($_GET['query']) && $_GET['query']=='switchAction' )
    {
        //this part is use to set switch on or off from website or app by change
        //the value of switch state in switch_table in database via get method
        //example-link: http://vrsim4learning.com/smartmeter/relaySwitch.php?query=switchAction&switchState=0
        $switchState = $_GET['switchState'];
        $sql = "UPDATE switch_table SET switchState = '{$switchState}' WHERE id = 1";
        echo $sql.'<br />';
        $result=mysql_query($sql);
        if($result)
        {
            echo "set Switch success";
        }
        else
        {
            echo mysql_error();
        }
    }
    else if( isset($_GET['query']) && $_GET['query']=='getSwitchState' )
    {
        //this part is use to get switch state from database to microcontroller 
        //via get method respond with echo php
        //example-link: http://vrsim4learning.com//smartmeter/relaySwitch.php?query=getSwitchState
        $sql="SELECT switchState FROM switch_table WHERE id = 1";
        $result = mysql_query($sql);
        if($result)
        {
            $result = mysql_fetch_assoc($result);
            echo 'swtichState='.$result['switchState'];
        }
        else
        {
            echo mysql_error();
        }

    }
?>