<html>
    <head>
        <link rel="stylesheet" href="surveyForm.css">
    </head>
    <body>
        <div class="form">
            <h2 >Welcome</h2>
            <br>
            <?php

                if(!isset($_POST["recommend"])){
                    $_POST["recommend"]=0;
                }
                if(!isset($_POST["fb"])){
                    $_POST["fb"]=0;
                }
                if(!isset($_POST["ig"])){
                    $_POST["ig"]=0;
                }
                if(!isset($_POST["yt"])){
                    $_POST["yt"]=0;
                }
                if(!isset($_POST["wp"])){
                    $_POST["wp"]=0;
                }
                if(!isset($_POST["check_list"])){
                    $_POST["check_list"]=0;
                }
                echo "<em>You have spent ".round(($_POST["time"]/24 )*100, precision: 2) ."% of your day on Social Media</em>";
                class user{
                    public $name;
                    public $age;
                    public function __construct($name,$age){
                        $this->name=$name;
                        $this->age=$age;
                    }
                }
                $user_details = new user($_POST["name"],$_POST["age"]);

                class survey
                {
                    public $recommend = null;
                    public $freq = null;
                    public $time = null;
                    public $account_count = 0;
                    public int $fb = 0;
                    public int $ig = 0;
                    public int $yt = 0;
                    public int $wp = 0;

                    public function __construct($recommend, $fb, $ig, $yt, $wp, $freq, $time)
                    {
                        $this->recommend = $recommend;
                        $this->freq = $freq;
                        $this->time = $time;
                        $this->fb = $fb;
                        $this->ig = $ig;
                        $this->yt = $yt;
                        $this->wp = $wp;
                        if($_POST["check_list"]!=0){
                            $this->account_count = count($_POST["check_list"]);
                        }
                        else $this->account_count=0;
                    }
                }
            $survey_entry= new survey($_POST["recommend"],$_POST["fb"],$_POST["ig"],$_POST["yt"],$_POST["wp"],$_POST["freq"],$_POST["time"]);

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "surveyForm";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "
insert into userdetails(name, age) VALUES ('$user_details->name','$user_details->age');
                        INSERT INTO surveyEntry(id,Recommendation, frequency, Time, account_count) VALUES (last_insert_id(),$survey_entry->recommend,'$survey_entry->freq',$survey_entry->time,$survey_entry->account_count)";
                $conn->exec($sql);
                    $last_id=$conn->lastInsertId();
                    echo "Inserted the details". $last_id;
                $get_data="SELECT userdetails.id , userdetails.name , userdetails.age, surveyEntry.account_count from userdetails
                           JOIN surveyEntry ON userdetails.id=surveyEntry.id";
                $query = $conn->prepare($get_data);
                $query->execute();

                echo"<table>
                        <tr>
                             <th>ID:</th>
                             <th>NAME</th>
                             <th>AGE</th>
                             <th>Accounts</th>
                        </tr>
                    </table>";
                while( $fill = $query->fetch()){

                    echo "
                         <table style='border: 3px solid black'>
                         
                         <tr>
                            <td>".$fill['id']."</td>
                            <td>".$fill["name"]."</td>
                            <td>".$fill["age"]."</td>
                            <td>".$fill["account_count"]."</td>
                         </tr>
                         </table>";
                }

                }
                catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                $conn = null;
            ?>
        </div>
    </body>
</html>
