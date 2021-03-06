<?php
class Gamecontroller
{
    public function __construct(Gameview $_View,Gamemodel $_Model)
    {
        $this->View = $_View;
        $this->Model = $_Model;
    }
    
    public function Init()
    {
        if($this->View->Doesuserwanttomove()) //If a gameseries is started, generate a board and after that start the game, and after that send data to model to validate.
        {
             $board = $this->View->Getaboard();
             $this->View->StartGame();
             $this->Model->ValidateData($board,$this->View->GetMovesMade());
        }
        
        if($this->View->Doesuserwanttoplayagain()) //If play again is pressed, redirect to gamepage and empty board.
        {
            $this->View->Getaboard();
            header("location:Index.php?Game");
            return $this->View;
        }
        
        if($this->View->DoesUserwanttostartagain()) //Go back to start
        {
            header("location:Index.php");
        }
        
        $this->View->Getaboard();
        return $this->View;
    }
    
    public function StartFT3Game()
    {
        $_SESSION["IsgameFT3"] = true;
        $this->Currentgamemode();
        $_SESSION["Currentgamemode"] = "First to three wins is the winner!";
        $this->Init();
    }
    
    public function StartFT5Game()
    {
        $_SESSION["IsgameFT3"] = false;
        $this->Currentgamemode();
        $_SESSION["Currentgamemode"] = "First to five wins is the winner!";
        $this->Init();
    }
    
    public function Currentgamemode()
    {
        if(!isset($_SESSION["Currentgamemode"]))
        {
            $_SESSION["Currentgamemode"] = "";
        }
        return $_SESSION["Currentgamemode"];
    }
}