<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

/**
* @var string|null
* @Assert\NotBlank(message="Merci de saisir votre nom")
* @Assert\Length(min=2, max=100)
*/
private $name;

/**
* @var string|null
* @Assert\NotBlank(message="Merci de saisir votre email")
* @Assert\Email
*/
private $email;

/**
* @var string|null
* @Assert\NotBlank(message="Merci de saisir votre numéro de téléphone")
* @Assert\Regex(pattern="/[0-9]{10}/")
*/
private $phone;

/**
* @var string|null
* @Assert\NotBlank(message="Merci de saisir votre message")
* @Assert\Length(min=10)
*/
private $message;


/**
 * Get the value of name
 *
 * @return  string|null
 */ 
public function getName()
{
return $this->name;
}

/**
 * Set the value of name
 *
 * @param  string|null  $name
 *
 * @return  self
 */ 
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get the value of email
 *
 * @return  string|null
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @param  string|null  $email
 *
 * @return  self
 */ 
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Get the value of phone
 *
 * @return  string|null
 */ 
public function getPhone()
{
return $this->phone;
}

/**
 * Set the value of phone
 *
 * @param  string|null  $phone
 *
 * @return  self
 */ 
public function setPhone($phone)
{
$this->phone = $phone;

return $this;
}

/**
 * Get the value of message
 *
 * @return  string|null
 */ 
public function getMessage()
{
return $this->message;
}

/**
 * Set the value of message
 *
 * @param  string|null  $message
 *
 * @return  self
 */ 
public function setMessage($message)
{
$this->message = $message;

return $this;
}
}