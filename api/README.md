# Quantum DreamForge API Documentation

## API Overview

The Quantum DreamForge API provides programmatic access to the game's core functionality, including user management, emotional energy systems, realm creation and evolution, and blockchain integration. This RESTful API uses JSON for request and response bodies.

### Base URL
```
https://quantum-dreamforge.com/api/v1/
```

### Authentication
Most endpoints require authentication using a JWT (JSON Web Token). Include the token in the Authorization header:

```
Authorization: Bearer YOUR_JWT_TOKEN
```

### Response Format
All responses follow a standard format:

```json
{
  "success": true,
  "data": {}, // Response data
  "message": "Operation successful"
}
```

For errors:

```json
{
  "success": false,
  "error": {
    "code": "ERROR_CODE",
    "message": "Error description"
  }
}
```

## API Endpoints

### User Management

#### POST /user/register
Register a new user account.

**Request Body:**
```json
{
  "username": "manifestor123",
  "email": "user@example.com",
  "password": "securepassword"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user_id": 123,
    "username": "manifestor123",
    "token": "eyJhbGciOiJIUzI1NiIsInR5..."
  },
  "message": "Registration successful"
}
```

#### POST /user/login
Authenticate a user and receive a JWT token.

**Request Body:**
```json
{
  "email": "user@example.com",
  "password": "securepassword"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user_id": 123,
    "username": "manifestor123",
    "token": "eyJhbGciOiJIUzI1NiIsInR5..."
  },
  "message": "Login successful"
}
```

#### GET /user/profile
Get the current user's profile information.

**Response:**
```json
{
  "success": true,
  "data": {
    "user_id": 123,
    "username": "manifestor123",
    "email": "user@example.com",
    "wallet_address": "0x...",
    "created_at": "2025-05-11T14:30:00Z",
    "realms_count": 3,
    "evolution_stage_highest": 4
  },
  "message": "Profile retrieved successfully"
}
```

#### PUT /user/profile
Update the current user's profile information.

**Request Body:**
```json
{
  "username": "new_username",
  "email": "newemail@example.com"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user_id": 123,
    "username": "new_username",
    "email": "newemail@example.com"
  },
  "message": "Profile updated successfully"
}
```

### Emotional Energy System

#### GET /energy/balance
Get the current user's emotional energy balances.

**Response:**
```json
{
  "success": true,
  "data": {
    "joy": 235.5,
    "serenity": 180.0,
    "wonder": 120.75,
    "melancholy": 90.25,
    "passion": 150.0,
    "fear": 75.5,
    "last_harvested": "2025-05-11T10:15:30Z"
  },
  "message": "Energy balances retrieved successfully"
}
```

#### POST /energy/harvest
Harvest emotional energy for the current user.

**Request Body:**
```json
{
  "energy_type": "joy",
  "source": "daily_activity"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "energy_type": "joy",
    "amount_harvested": 25.5,
    "new_balance": 261.0,
    "next_harvest_available": "2025-05-11T14:15:30Z"
  },
  "message": "Energy harvested successfully"
}
```

#### POST /energy/convert
Convert one type of emotional energy to another.

**Request Body:**
```json
{
  "from_type": "passion",
  "to_type": "wonder",
  "amount": 50.0
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "from_type": "passion",
    "from_amount": 50.0,
    "from_balance": 100.0,
    "to_type": "wonder",
    "to_amount": 37.5,
    "to_balance": 158.25,
    "conversion_rate": 0.75
  },
  "message": "Energy converted successfully"
}
```

### Realm Management

#### GET /realm/list
Get all realms owned by the current user.

**Response:**
```json
{
  "success": true,
  "data": {
    "realms": [
      {
        "id": 456,
        "name": "Crystal Haven",
        "evolution_stage": 3,
        "dominant_energy": "wonder",
        "created_at": "2025-04-15T09:20:10Z",
        "thumbnail_url": "/assets/images/realm_thumbnails/456.png"
      },
      {
        "id": 789,
        "name": "Serene Meadows",
        "evolution_stage": 2,
        "dominant_energy": "serenity",
        "created_at": "2025-05-01T16:45:22Z",
        "thumbnail_url": "/assets/images/realm_thumbnails/789.png"
      }
    ],
    "total_count": 2
  },
  "message": "Realms retrieved successfully"
}
```

#### GET /realm/{id}
Get detailed information about a specific realm.

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 456,
    "name": "Crystal Haven",
    "description": "A realm of wonder and discovery",
    "evolution_stage": 3,
    "evolution_progress": {
      "current_stage": 3,
      "next_stage": 4,
      "progress_percentage": 45,
      "requirements_met": {
        "emotional_total": true,
        "min_dominant_energy": false,
        "features_required": true,
        "evolution_days": true
      }
    },
    "emotional_signature": {
      "dominant": "wonder",
      "secondary": "joy",
      "composition": {
        "joy": 25,
        "serenity": 10,
        "wonder": 45,
        "melancholy": 5,
        "passion": 10,
        "fear": 5
      }
    },
    "features": [
      {
        "id": 101,
        "name": "Wonder Crystals",
        "category": "artifact",
        "position": {"x": 150, "y": 200},
        "energy_generation": {"wonder": 0.7}
      },
      {
        "id": 102,
        "name": "Joy Fountain",
        "category": "structure",
        "position": {"x": 300, "y": 250},
        "energy_generation": {"joy": 0.8}
      }
    ],
    "energy_generation": {
      "joy": 1.2,
      "serenity": 0.3,
      "wonder": 2.1,
      "melancholy": 0.0,
      "passion": 0.5,
      "fear": 0.0
    },
    "created_at": "2025-04-15T09:20:10Z",
    "nft_token_id": "12345",
    "nft_contract_address": "0x..."
  },
  "message": "Realm retrieved successfully"
}
```

#### POST /realm/create
Create a new realm.

**Request Body:**
```json
{
  "name": "Mystic Valley",
  "description": "A tranquil valley filled with mysterious energy",
  "primary_energy": "serenity",
  "secondary_energy": "wonder",
  "template_id": 3
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "realm_id": 790,
    "name": "Mystic Valley",
    "evolution_stage": 1,
    "energy_costs": {
      "joy": 20.0,
      "serenity": 100.0,
      "wonder": 50.0
    },
    "remaining_energy": {
      "joy": 215.5,
      "serenity": 80.0,
      "wonder": 70.75
    }
  },
  "message": "Realm created successfully"
}
```

#### PUT /realm/{id}
Update an existing realm.

**Request Body:**
```json
{
  "name": "Mystic Valley Reborn",
  "description": "The valley has transformed with new energies"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "realm_id": 790,
    "name": "Mystic Valley Reborn",
    "description": "The valley has transformed with new energies"
  },
  "message": "Realm updated successfully"
}
```

#### POST /realm/{id}/feature/add
Add a feature to a realm.

**Request Body:**
```json
{
  "feature_id": 103,
  "position": {"x": 400, "y": 300}
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "realm_id": 790,
    "feature": {
      "id": 103,
      "name": "Serene Meadow",
      "category": "landscape",
      "position": {"x": 400, "y": 300},
      "energy_generation": {"serenity": 0.5}
    },
    "energy_costs": {
      "joy": 20.0,
      "serenity": 50.0
    },
    "remaining_energy": {
      "joy": 195.5,
      "serenity": 30.0
    },
    "new_energy_generation": {
      "serenity": 1.0
    }
  },
  "message": "Feature added successfully"
}
```

#### POST /realm/{id}/evolve
Trigger realm evolution if requirements are met.

**Response:**
```json
{
  "success": true,
  "data": {
    "realm_id": 790,
    "previous_stage": 1,
    "new_stage": 2,
    "rewards": {
      "feature_slots": 5,
      "max_energy_capacity": 300,
      "energy_generation_bonus": 0.1
    },
    "unlocked_features": [
      {
        "id": 104,
        "name": "Wonder Crystals",
        "category": "artifact"
      }
    ]
  },
  "message": "Realm evolved successfully"
}
```

### Blockchain Integration

#### GET /blockchain/wallet/status
Check wallet connection status.

**Response:**
```json
{
  "success": true,
  "data": {
    "connected": true,
    "address": "0x...",
    "network": "polygon",
    "balance": "0.05 MATIC"
  },
  "message": "Wallet status retrieved successfully"
}
```

#### POST /blockchain/realm/mint
Mint a realm as an NFT.

**Request Body:**
```json
{
  "realm_id": 790,
  "gas_price": "standard"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "realm_id": 790,
    "transaction_hash": "0x...",
    "nft_token_id": "54321",
    "nft_contract_address": "0x...",
    "blockchain_explorer_url": "https://polygonscan.com/tx/0x..."
  },
  "message": "Realm minting initiated successfully"
}
```

#### GET /blockchain/transactions
Get all blockchain transactions for the current user.

**Response:**
```json
{
  "success": true,
  "data": {
    "transactions": [
      {
        "id": 123,
        "type": "nft_mint",
        "realm_id": 790,
        "transaction_hash": "0x...",
        "status": "completed",
        "created_at": "2025-05-11T14:30:00Z"
      },
      {
        "id": 124,
        "type": "marketplace",
        "realm_id": 456,
        "transaction_hash": "0x...",
        "status": "pending",
        "created_at": "2025-05-11T15:45:00Z"
      }
    ]
  },
  "message": "Transactions retrieved successfully"
}
```
