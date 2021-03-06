<?php

namespace AduanaBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 */
class Usuario Implements UserInterface, \Serializable {

    /**
     * @var integer
     */
    private $idusuario;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $rol;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $bio;
    
    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getIdusuario() {
        return $this->idusuario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido) {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return integer
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password) {
        
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        
        return $this->password;
    
        
    }

    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Usuario
     */
    public function setRol($rol) {
        
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol() {
        
        return $this->rol;
    
        
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Usuario
     */
    public function setimagen($imagen) {
        
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imgen
     *
     * @return string
     */
    public function getImagen() {
        
        return $this->imagen;
    }
        /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Usuario
     */
    public function setBio($bio) {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get $bio
     *
     * @return $bio
     */
    public function getBio() {
        return $this->bio;
    }

    
    //
    public function serialize() {

        return serialize(array($this->idusuario, $this->email, $this->password));
    }

    //
    public function unserialize($serialized) {

        list($this->idusuario, $this->email, $this->password) = unserialize($serialized);
    }

    //
    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return array('user','admin');
    
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
         return $this->email;
    }
    
    
    public function _toString(){
        return $this->nombre . " " . $this->apellido;
    }


}
