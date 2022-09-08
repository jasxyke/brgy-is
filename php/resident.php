<?php 

//resident class
class Resident{
    //properties
    protected $residentID;
    protected $famID;
    protected $lastname;
    protected $firstname;
    protected $middlename;
    protected $birthdate;
    protected $occupation;
    protected $mobilenum;
    protected $email;
    protected $vaccState;

    //constructor
    function __construct(int $famID, string $lastname, string $firstname, 
    string $middlename, string $mobilenum){
        $this->famID = $famID;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->mobilenum = $mobilenum;
    }

    public function getFullname(){
        return $this->firstname . " " . substr($this->middlename, 0, 1) . ". " . $this->lastname;
    }

    ///////////
    //GETTERS//
    ///////////
    public function getResidentID(){
        return $this->residentID;
    }

    public function getFamiD(){
        return $this->famID;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getMidname(){
        return $this->middlename;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }

    public function getOccupation(){
        return $this->occupation;
    }

    public function getMobilenum(){
        return $this->mobilenum;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getVaccstate(){
        return $this->vaccState;
    }
    ////////////
    //SETTERS//
    //////////
    public function setfamID($ID){
        $this->famID = $ID;
    }

    public function setLastname($ln){
        $this->lastname = $ln;
    }

    public function setFirstname($fn){
        $this->firstname = $fn;
    }

    public function setMiddlename($mn){
        $this->middlename = $mn;
    }

    public function setBirthdate($date){
        $this->birthdate = $date;
    }

    public function setOccupation($occ){
        $this->occupation = $occ;
    }

    public function setMobilenum($num){
        $this->mobilenum = $num;
    }

    public function setEmail($em){
        $this->email = $em;
    }
    
    public function setVaccstate($state){
        $this->vaccState = $state;
    }
}
?>