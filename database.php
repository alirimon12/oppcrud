
<?php   

class database{

   private $host;
   private $dbusername;
   private $dbpassword;
   private $dbname; 
   

   protected function connect() 


   {

  
     $this->host='localhost';
     $this->dbusername='root';
     $this->dbpassword='';
     $this->dbname='crud';  

  

    $con= new mysqli($this->host, $this->dbusername, $this->dbpassword, $this->dbname );  

     return $con;
      
   }
    
}  
class query extends database{
//select * from user where id=1 and name="alirimon" order by id asc;
   //mysqli_query($con, $result);
   public function getData($table, $field='', $arr_conditon='', $order_by_type='', $desc_asc='') 

   {

     $selectData="SELECT $field from $table  ";  
    
        
      if($arr_conditon!='') 

      {
           
        $selectData.=" where  ";

        $c=count($arr_conditon);
        $i=1;

        foreach($arr_conditon as $key=>$val)
                {
                      
                   if($i==$c) 

                   {

                    $selectData.=" $key='$val'";

                   }else{

                    $selectData.=" $key='$val' and";
 
                   }

                    $i++;      
                  
                }
   
      }  

     if($order_by_type!='') 

     {

      $selectData.=" order by $order_by_type $desc_asc ";

     }


      //print_r($arr_conditon);
     
      //die($selectData);  
   $result=$this->connect()->query($selectData);

         
         if($result->num_rows > 0) 

         {
               $arr=array();
              while($row=$result->fetch_assoc()) 
               {
              
                $arr[]=$row; 

               }   

            return  $arr;  

         }else{

          return  0;

         }


   }

  
    // insert into table(name, email, mobile) vlaue('name', 'email', 'mobile');


   public function insertData($table,  $arr_conditon='') 



   {
   
          if($arr_conditon!='') 

            {

              foreach($arr_conditon as $key=>$val)
                  {

                       $fieldArr[]=$key;
                       $valArr[]=$val;

                  }

                $field=implode(", ", $fieldArr);
                $value=implode(" ',' ", $valArr);
                
               // echo  $value;

            }

      $inserData="INSERT into $table($field) Value ( '$value' ) ";
       
      $result=$this->connect()->query($inserData);

      //die($inserData);

      //echo "<pre>";
     //print_r( $arr_conditon);
    

   }


///  update table set name="alirimon" where id=6


    public function updateData($table, $arr_conditon='',  $where_field, $where_value) 

    {

    $updateData="UPDATE $table set "; 


          if($arr_conditon!='') 

          {

             foreach($arr_conditon as $key=>$val)
             
              {

                $updateData.=" $key='$val' "; 


              }
          }  
          $updateData.=" where $where_field='$where_value' "; 
          $result=$this->connect()->query($updateData);
          //die($updateData);


    }



/// delete from $table where id=6;
    public function deleteData($table, $arr_conditon) 

    {

      $deleteData="DELETE from $table where ";
     
         
    if($arr_conditon!='') 

     {
       
      $c=count($arr_conditon); 

      $i=1;

      
      foreach($arr_conditon as $key=>$val) 
      
      {
        
          if($i==$c) 

          {

        $deleteData.=" $key='$val' ";
            

          }else{

            $deleteData.=" $key='$val' and ";
            
          }

       $i++;

      }


  

     }



     $result=$this->connect()->query($deleteData);  

    }





  }


?>