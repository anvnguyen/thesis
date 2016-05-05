<?php
class RbacCommand extends CConsoleCommand
{
    private $_authManager;
    public function getHelp()
    {
        return <<<EOD
USAGE
  rbac
DESCRIPTION
  This command generates an initial RBAC authorization hierarchy.
EOD;
    }
    /**
     * Execute the action.
     * @param array command line parameters specific for this command
     */
    public function run($args)
    {
        if(($this->_authManager=Yii::app()->authManager)===null)
        {
          echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
          echo "If you already added 'authManager' component in application configuration,\n";
          echo "please quit and re-enter the yiic shell.\n";
          return;
        }  
        echo "This command will create three roles: admin, member, and banned and the following premissions:\n";
        echo "create, read, update and delete user\n";
        echo "Would you like to continue? [Yes|No] ";
        if(!strncasecmp(trim(fgets(STDIN)),'y',1)) 
        {
            $this->_authManager->clearAll();
            $this->_authManager->createOperation("createUser","create a new user"); 
            $this->_authManager->createOperation("readUser","read user profile information"); 
            $this->_authManager->createOperation("updateUser","update a users information"); 
            $this->_authManager->createOperation("deleteUser","remove a user from system"); 
            $role=$this->_authManager->createRole("banned"); 
            $role->addChild("readUser");
            $role=$this->_authManager->createRole("member"); 
            $role->addChild("banned"); 
            $role->addChild("updateUser");
            $role=$this->_authManager->createRole("admin"); 
            $role->addChild("member");   
            $role->addChild("createUser");              
            $role->addChild("deleteUser");     
            echo "Authorization hierarchy successfully generated.";
        } 
    }
}