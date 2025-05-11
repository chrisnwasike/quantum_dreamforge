<?php
class Realm {
    // Database connection and table name
    private $conn;
    private $table_name = "realms";
    
    // Object properties
    public $id;
    public $user_id;
    public $name;
    public $description;
    public $emotional_signature;
    public $creation_date;
    public $last_updated;
    public $evolution_stage;
    public $features;
    public $nft_token_id;
    
    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Create new realm
    public function create() {
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->emotional_signature = htmlspecialchars(strip_tags($this->emotional_signature));
        
        // Create query
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    user_id = :user_id,
                    name = :name,
                    description = :description,
                    emotional_signature = :emotional_signature,
                    creation_date = NOW(),
                    last_updated = NOW(),
                    evolution_stage = 1,
                    features = :features";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":emotional_signature", $this->emotional_signature);
        $stmt->bindParam(":features", $this->features);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Get realm by ID
    public function getById($id) {
        // Query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Bind ID
        $stmt->bindParam(1, $id);
        
        // Execute query
        $stmt->execute();
        
        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Set properties
        if($row) {
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->emotional_signature = $row['emotional_signature'];
            $this->creation_date = $row['creation_date'];
            $this->last_updated = $row['last_updated'];
            $this->evolution_stage = $row['evolution_stage'];
            $this->features = $row['features'];
            $this->nft_token_id = $row['nft_token_id'];
            return true;
        }
        
        return false;
    }
    
    // Get all realms by user
    public function getByUser($user_id) {
        // Create query
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ?";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Bind user ID
        $stmt->bindParam(1, $user_id);
        
        // Execute query
        $stmt->execute();
        
        return $stmt;
    }
    
    // Update realm
    public function update() {
        // Create query
        $query = "UPDATE " . $this->table_name . "
                  SET
                    name = :name,
                    description = :description,
                    emotional_signature = :emotional_signature,
                    last_updated = NOW(),
                    evolution_stage = :evolution_stage,
                    features = :features,
                    nft_token_id = :nft_token_id
                  WHERE
                    id = :id";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize and bind parameters
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->emotional_signature = htmlspecialchars(strip_tags($this->emotional_signature));
        $this->evolution_stage = htmlspecialchars(strip_tags($this->evolution_stage));
        $this->features = $this->features;
        $this->nft_token_id = htmlspecialchars(strip_tags($this->nft_token_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':emotional_signature', $this->emotional_signature);
        $stmt->bindParam(':evolution_stage', $this->evolution_stage);
        $stmt->bindParam(':features', $this->features);
        $stmt->bindParam(':nft_token_id', $this->nft_token_id);
        $stmt->bindParam(':id', $this->id);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Additional methods for realm evolution, energy management, etc.
}
?>