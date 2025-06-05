<?php
namespace App\Models;

class Friendship extends BaseModel {
    protected $table = 'friendships';
    
    // Get all friends for a user
    public function getFriends($userId) {
        $query = "SELECT u.* FROM users u
                JOIN {$this->table} f ON (u.user_id = f.user_id_1 OR u.user_id = f.user_id_2)
                WHERE (f.user_id_1 = :user_id OR f.user_id_2 = :user_id)
                AND f.status = 'accepted'
                AND u.user_id != :user_id";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }

/**
 * Get friendship by ID - FIXED VERSION
 * @param int $friendshipId
 * @return object|false
 */
public function getById($friendshipId) {
    $query = "SELECT * FROM {$this->table} WHERE friendship_id = :friendship_id";
    $params = ['friendship_id' => $friendshipId];
    return $this->db->query($query, $params)->fetch();
}

    /**
 * Get the count of friends for a user
 * @param int $userId
 * @return int
 */
public function getFriendCount($userId) {
    $query = "SELECT COUNT(*) as count 
              FROM {$this->table} 
              WHERE (user_id_1 = :user_id OR user_id_2 = :user_id)
              AND status = 'accepted'";
    $params = ['user_id' => $userId];
    $result = $this->db->query($query, $params)->fetch();
    return $result->count;
}

/**
 * Get a limited list of friends for a user
 * @param int $userId
 * @param int $limit How many friends to return
 * @return array
 */
public function getLimitedFriends($userId, $limit = 5) {
    $query = "SELECT u.*
              FROM users u
              JOIN {$this->table} f ON 
                  (u.user_id = f.user_id_1 OR u.user_id = f.user_id_2)
              WHERE 
                  ((f.user_id_1 = :user_id AND f.user_id_2 = u.user_id) OR 
                  (f.user_id_2 = :user_id AND f.user_id_1 = u.user_id))
              AND f.status = 'accepted'
              LIMIT :limit";
    $params = [
        'user_id' => $userId,
        'limit' => $limit
    ];
    return $this->db->query($query, $params)->fetchAll();
}
    // Get pending friend requests sent to user
    public function getPendingRequestsReceived($userId) {
        $query = "SELECT f.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} f
                JOIN users u ON f.user_id_1 = u.user_id
                WHERE f.user_id_2 = :user_id AND f.status = 'pending'
                ORDER BY f.created_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get pending friend requests sent by user
    public function getPendingRequestsSent($userId) {
        $query = "SELECT f.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} f
                JOIN users u ON f.user_id_2 = u.user_id
                WHERE f.user_id_1 = :user_id AND f.status = 'pending'
                ORDER BY f.created_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
 * Accept a friend request - FIXED VERSION
 * @param int $friendshipId
 * @return bool
 */
public function acceptRequest($friendshipId) {
    $query = "UPDATE {$this->table} 
              SET status = 'accepted', 
                  updated_at = CURRENT_TIMESTAMP 
              WHERE friendship_id = :friendship_id";
    $params = ['friendship_id' => $friendshipId];
    $result = $this->db->query($query, $params);
    return $result !== false;
}

/**
 * Decline a friend request - FIXED VERSION  
 * @param int $friendshipId
 * @return bool
 */
public function declineRequest($friendshipId) {
    $query = "UPDATE {$this->table} 
              SET status = 'declined', 
                  updated_at = CURRENT_TIMESTAMP 
              WHERE friendship_id = :friendship_id";
    $params = ['friendship_id' => $friendshipId];
    $result = $this->db->query($query, $params);
    return $result !== false;
}

    
    // Check if users are friends
    public function areFriends($userId1, $userId2) {
        $query = "SELECT * FROM {$this->table}
                WHERE ((user_id_1 = :user_id_1 AND user_id_2 = :user_id_2)
                OR (user_id_1 = :user_id_2 AND user_id_2 = :user_id_1))
                AND status = 'accepted'";
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ];
        return $this->db->query($query, $params)->fetch() ? true : false;
    }
    
    /**
 * Check friendship status between two users - FIXED VERSION
 * @param int $userId1
 * @param int $userId2  
 * @return string Status: 'none', 'pending', 'accepted', 'declined'
 */
public function checkFriendshipStatus($userId1, $userId2) {
    $query = "SELECT status FROM {$this->table}
              WHERE ((user_id_1 = :user_id_1 AND user_id_2 = :user_id_2)
              OR (user_id_1 = :user_id_2 AND user_id_2 = :user_id_1))
              ORDER BY created_at DESC 
              LIMIT 1";
    $params = [
        'user_id_1' => $userId1,
        'user_id_2' => $userId2
    ];
    $result = $this->db->query($query, $params)->fetch();
    
    return $result ? $result->status : 'none';
}
       /**
     * Get mutual friends between two users with detailed information
     * @param int $userId1 First user ID
     * @param int $userId2 Second user ID
     * @param int $limit Maximum number of results (default: 10)
     * @return array Array of mutual friends with details
     */
    public function getMutualFriendsDetailed($userId1, $userId2, $limit = 10) {
        $query = "SELECT DISTINCT
            u.user_id,
            u.first_name,
            u.last_name,
            u.profile_picture,
            u.city,
            u.country,
            u.occupation,
            u.bio,
            
            -- When they became friends with user1
            CASE 
                WHEN f1.user_id_1 = :user_id_1 THEN f1.created_at
                ELSE f1.created_at
            END as friends_with_user1_since,
            
            -- When they became friends with user2  
            CASE 
                WHEN f2.user_id_1 = :user_id_2 THEN f2.created_at
                ELSE f2.created_at
            END as friends_with_user2_since,
            
            -- Calculate who became friends first
            CASE 
                WHEN f1.created_at < f2.created_at THEN 'user1_first'
                WHEN f2.created_at < f1.created_at THEN 'user2_first'
                ELSE 'same_time'
            END as friendship_order
            
        FROM users u
        
        -- Friends with user1
        JOIN friendships f1 ON (
            (f1.user_id_1 = :user_id_1 AND f1.user_id_2 = u.user_id) OR
            (f1.user_id_2 = :user_id_1 AND f1.user_id_1 = u.user_id)
        )
        
        -- Also friends with user2
        JOIN friendships f2 ON (
            (f2.user_id_1 = :user_id_2 AND f2.user_id_2 = u.user_id) OR
            (f2.user_id_2 = :user_id_2 AND f2.user_id_1 = u.user_id)
        )
        
        WHERE f1.status = 'accepted' 
        AND f2.status = 'accepted'
        AND u.user_id != :user_id_1 
        AND u.user_id != :user_id_2
        
        ORDER BY u.first_name, u.last_name
        LIMIT :limit";
        
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2,
            'limit' => $limit
        ];
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get count of mutual friends between two users
     * @param int $userId1 First user ID
     * @param int $userId2 Second user ID
     * @return int Count of mutual friends
     */
    public function getMutualFriendsCount($userId1, $userId2) {
        $query = "SELECT COUNT(DISTINCT u.user_id) as mutual_count
        FROM users u
        
        -- Friends with user1
        JOIN friendships f1 ON (
            (f1.user_id_1 = :user_id_1 AND f1.user_id_2 = u.user_id) OR
            (f1.user_id_2 = :user_id_1 AND f1.user_id_1 = u.user_id)
        )
        
        -- Also friends with user2
        JOIN friendships f2 ON (
            (f2.user_id_1 = :user_id_2 AND f2.user_id_2 = u.user_id) OR
            (f2.user_id_2 = :user_id_2 AND f2.user_id_1 = u.user_id)
        )
        
        WHERE f1.status = 'accepted' 
        AND f2.status = 'accepted'
        AND u.user_id != :user_id_1 
        AND u.user_id != :user_id_2";
        
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ];
        
        $result = $this->db->query($query, $params)->fetch();
        return $result->mutual_count ?? 0;
    }
    
    /**
     * Get mutual friends for display (simple version)
     * Perfect for showing "3 mutual friends" with profile pictures
     * @param int $userId1 First user ID
     * @param int $userId2 Second user ID
     * @param int $limit Maximum number to return (default: 5)
     * @return array Simple array with basic user info
     */
    public function getMutualFriendsSimple($userId1, $userId2, $limit = 5) {
        $query = "SELECT DISTINCT
            u.user_id,
            u.first_name,
            u.last_name,
            u.profile_picture
            
        FROM users u
        
        -- Friends with user1
        JOIN friendships f1 ON (
            (f1.user_id_1 = :user_id_1 AND f1.user_id_2 = u.user_id) OR
            (f1.user_id_2 = :user_id_1 AND f1.user_id_1 = u.user_id)
        )
        
        -- Also friends with user2
        JOIN friendships f2 ON (
            (f2.user_id_1 = :user_id_2 AND f2.user_id_2 = u.user_id) OR
            (f2.user_id_2 = :user_id_2 AND f2.user_id_1 = u.user_id)
        )
        
        WHERE f1.status = 'accepted' 
        AND f2.status = 'accepted'
        AND u.user_id != :user_id_1 
        AND u.user_id != :user_id_2
        
        ORDER BY u.first_name
        LIMIT :limit";
        
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2,
            'limit' => $limit
        ];
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get users who have the most mutual friends with a given user
     * Great for friend suggestions!
     * @param int $userId The user to find suggestions for
     * @param int $limit Number of suggestions to return
     * @return array Users with mutual friend counts
     */
    public function getFriendSuggestions($userId, $limit = 10) {
        $query = "SELECT 
            u.user_id,
            u.first_name,
            u.last_name,
            u.profile_picture,
            u.city,
            u.country,
            u.occupation,
            COUNT(DISTINCT mutual_friend.user_id) as mutual_friends_count
            
        FROM users u
        
        -- Find users who are friends with our user's friends
        JOIN friendships f_mutual ON (
            (f_mutual.user_id_1 = u.user_id OR f_mutual.user_id_2 = u.user_id)
            AND f_mutual.status = 'accepted'
        )
        
        -- Get the mutual friend
        JOIN users mutual_friend ON (
            CASE 
                WHEN f_mutual.user_id_1 = u.user_id THEN f_mutual.user_id_2
                ELSE f_mutual.user_id_1
            END = mutual_friend.user_id
        )
        
        -- Make sure the mutual friend is actually friends with our target user
        JOIN friendships f_target ON (
            (f_target.user_id_1 = :user_id AND f_target.user_id_2 = mutual_friend.user_id) OR
            (f_target.user_id_2 = :user_id AND f_target.user_id_1 = mutual_friend.user_id)
        )
        
        WHERE u.user_id != :user_id  -- Don't suggest the user themselves
        AND f_target.status = 'accepted'
        
        -- Exclude users who are already friends with our target user
        AND u.user_id NOT IN (
            SELECT CASE 
                WHEN existing.user_id_1 = :user_id THEN existing.user_id_2
                ELSE existing.user_id_1
            END
            FROM friendships existing
            WHERE (existing.user_id_1 = :user_id OR existing.user_id_2 = :user_id)
            AND existing.status IN ('accepted', 'pending')
        )
        
        GROUP BY u.user_id
        HAVING mutual_friends_count > 0
        ORDER BY mutual_friends_count DESC, u.first_name
        LIMIT :limit";
        
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get detailed mutual friends analysis between two users
     * Includes statistics and insights
     * @param int $userId1 First user ID
     * @param int $userId2 Second user ID
     * @return object Analysis object with statistics
     */
    public function getMutualFriendsAnalysis($userId1, $userId2) {
        // Get basic count
        $mutualCount = $this->getMutualFriendsCount($userId1, $userId2);
        
        // Get user1's total friends
        $user1FriendsQuery = "SELECT COUNT(DISTINCT 
            CASE 
                WHEN f.user_id_1 = :user_id_1 THEN f.user_id_2
                ELSE f.user_id_1
            END
        ) as total_friends
        FROM friendships f
        WHERE (f.user_id_1 = :user_id_1 OR f.user_id_2 = :user_id_1)
        AND f.status = 'accepted'";
        
        $user1Friends = $this->db->query($user1FriendsQuery, ['user_id_1' => $userId1])->fetch();
        
        // Get user2's total friends
        $user2FriendsQuery = "SELECT COUNT(DISTINCT 
            CASE 
                WHEN f.user_id_1 = :user_id_2 THEN f.user_id_2
                ELSE f.user_id_1
            END
        ) as total_friends
        FROM friendships f
        WHERE (f.user_id_1 = :user_id_2 OR f.user_id_2 = :user_id_2)
        AND f.status = 'accepted'";
        
        $user2Friends = $this->db->query($user2FriendsQuery, ['user_id_2' => $userId2])->fetch();
        
        // Calculate percentages
        $user1Total = $user1Friends->total_friends ?? 0;
        $user2Total = $user2Friends->total_friends ?? 0;
        
        $user1Percentage = $user1Total > 0 ? round(($mutualCount / $user1Total) * 100, 1) : 0;
        $user2Percentage = $user2Total > 0 ? round(($mutualCount / $user2Total) * 100, 1) : 0;
        
        return (object) [
            'mutual_friends_count' => $mutualCount,
            'user1_total_friends' => $user1Total,
            'user2_total_friends' => $user2Total,
            'user1_mutual_percentage' => $user1Percentage,
            'user2_mutual_percentage' => $user2Percentage,
            'connection_strength' => $this->calculateConnectionStrength($mutualCount, $user1Total, $user2Total)
        ];
    }
    
    /**
     * Calculate connection strength between users based on mutual friends
     * @param int $mutualCount Number of mutual friends
     * @param int $user1Total User 1's total friends
     * @param int $user2Total User 2's total friends
     * @return string Connection strength level
     */
    private function calculateConnectionStrength($mutualCount, $user1Total, $user2Total) {
        if ($mutualCount == 0) return 'none';
        
        $avgFriends = ($user1Total + $user2Total) / 2;
        $percentage = $avgFriends > 0 ? ($mutualCount / $avgFriends) * 100 : 0;
        
        if ($percentage >= 50) return 'very_strong';
        if ($percentage >= 30) return 'strong';
        if ($percentage >= 15) return 'moderate';
        if ($percentage >= 5) return 'weak';
        return 'very_weak';
    }

    /**
 * Delete a friendship/friend request
 * @param int $friendshipId
 * @return bool
 */
public function delete($friendshipId) {
    $query = "DELETE FROM {$this->table} WHERE friendship_id = :friendship_id";
    $params = ['friendship_id' => $friendshipId];
    $result = $this->db->query($query, $params);
    return $result !== false;
}
}

