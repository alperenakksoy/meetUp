<?php

/**
 *  Get the base Path
 * @param string $path
 * @return string
 */
 function basePath($path){
    return __DIR__ . '/' . $path;
 }

 /**
  * Load a view
  * @param string $name
  * @return void
  */
  function loadView($name,$data=[]){
   $viewPath =  basePath("App/views/listings/{$name}.view.php");

   if(file_exists($viewPath)){
      extract($data); // allows us to access data
       require $viewPath;
   } else {
      echo "view '{$name} not found!'";
   }
  } 
  

  /**
 * Load a partial
 * @param string $name
 * @return void
 */
 function loadPartial($name, $data=[]){
   $partialPath = basePath("App/views/partials/{$name}.php");
   if(file_exists($partialPath)){
      extract($data); // allows us to access data 
      require $partialPath;
  } else {
     echo "view '{$name} not found!'";
  }
 }

 function loadWelcomePartial($name){
    $partialPath = basePath("App/views/welcomePartials/{$name}.php");
    if(file_exists($partialPath)){
       require $partialPath;
   } else {
      echo "view '{$name} not found!'";
   }
  }

 /** Inspect value(s)
  * @param mixed $value 
  * @return void
  */
  function inspect($value){
   echo '<pre>';
   var_dump($value);
   echo '</pre>';
  }
/** Inspect value(s) and die
 * @param mixed $value 
 * @return void
 */
function inspectAndDie($value): void {
   echo '<pre>';
   var_dump($value);
   echo '</pre>';
   die(); // Ensure output is printed before termination
}

/**   
 * Sanitize Data TO prevent instert a code in to the post method for security
 * 
 * @return string $dirty
 * @return string
 */

 function sanitize($dirty){
   return filter_var(trim($dirty),FILTER_SANITIZE_SPECIAL_CHARS);
 }

 /**
  * Redirect to a given URL
  * 
  * @param string $url
  * @return void
  */

  function redirect($url){
   header("Location: {$url}");
   exit;
  }

  /**
   * Rewrite the date format in MONTH DAY, YEAR
   * @param string $date
   */
  function reDate($date){
   return date('F j, Y', strtotime($date));
  }


  /**
   * Rewrite the TIME format in HOURS:MINUTE IN 24H FORMAT 15:00
   * @param string $time
   */
  function reTime($time){
   return date('H:i', strtotime($time));
  }

  /**
   * Calculate the age from database
   * @param mixed
   * @return int
   */
   function calcAge($date){
   $birthdate = $date; // Replace with the value from your DB

   $birthDate = new DateTime($birthdate);
   $today = new DateTime();
   $age = $birthDate->diff($today)->y;
    return $age;
  }

/**
 * Get the event image path with fallback to category default
 * @param object $event The event object
 * @param string $size Optional size (thumbnail, full)
 * @return string The image path
 */
function getEventImage($event, $size = 'full') {
    // Define default images for each category
    $categoryDefaults = [
        'coffee' => 'default_coffee.jpg',
        'cultural' => 'default_cultural.jpg',
        'sports' => 'default_sports.jpg',
        'language' => 'default_language.jpg',
        'food' => 'default_food.jpg',
        'art' => 'default_art.jpg',
        'tech' => 'default_tech.jpg',
        'other' => 'default_event.jpg'
    ];
    
    // Check if event has a custom image
    if (!empty($event->cover_image) && file_exists(basePath('public/uploads/events/' . $event->cover_image))) {
        return '/uploads/events/' . $event->cover_image;
    }
    
    // Get category-specific default image
    $category = strtolower($event->category ?? 'other');
    $defaultImage = $categoryDefaults[$category] ?? $categoryDefaults['other'];
    
    // Return path to default image
    return '/uploads/events/defaults/' . $defaultImage;
}

/**
 * Get category icon class
 * @param string $category
 * @return string Font Awesome icon class
 */
function getCategoryIcon($category) {
    $icons = [
        'coffee' => 'fas fa-coffee',
        'cultural' => 'fas fa-landmark',
        'sports' => 'fas fa-running',
        'language' => 'fas fa-language',
        'food' => 'fas fa-utensils',
        'art' => 'fas fa-palette',
        'tech' => 'fas fa-laptop-code',
        'other' => 'fas fa-calendar-alt'
    ];
    
    $category = strtolower($category ?? 'other');
    return $icons[$category] ?? $icons['other'];
}

/**
 * Get category color class
 * @param string $category
 * @return string Tailwind color class
 */
function getCategoryColor($category) {
    $colors = [
        'coffee' => 'bg-amber-600',
        'cultural' => 'bg-purple-600',
        'sports' => 'bg-green-600',
        'language' => 'bg-blue-600',
        'food' => 'bg-red-600',
        'art' => 'bg-pink-600',
        'tech' => 'bg-indigo-600',
        'other' => 'bg-gray-600'
    ];
    
    $category = strtolower($category ?? 'other');
    return $colors[$category] ?? $colors['other'];
}

function timeSince(string $createdAt): string {
    $createdTime = new DateTime($createdAt);
    $now = new DateTime();
    $interval = $createdTime->diff($now);

    if ($interval->y > 0) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m > 0) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } elseif ($interval->i > 0) {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } else {
        return 'Just now';
    }
}

/**
 * UPDATED: Get user profile picture URL with proper fallback handling
 * @param object|array $user User object or array with profile_picture, first_name, last_name
 * @param int $size Size for placeholder image (default: 150)
 * @return string Profile picture URL
 */
function getUserProfilePicture($user, $size = 150) {
    // Handle both object and array inputs
    $profilePicture = is_object($user) ? ($user->profile_picture ?? '') : ($user['profile_picture'] ?? '');
    $firstName = is_object($user) ? ($user->first_name ?? 'U') : ($user['first_name'] ?? 'U');
    $lastName = is_object($user) ? ($user->last_name ?? 'ser') : ($user['last_name'] ?? 'ser');
    
    // Check if user has a custom profile picture
    if (!empty($profilePicture) && $profilePicture !== 'default_profile.jpg') {
        // If it's already a full URL, return as is
        if (str_starts_with($profilePicture, 'http')) {
            return $profilePicture;
        }
        // Otherwise, prepend the uploads path
        return '/uploads/profiles/' . $profilePicture;
    }
    
    // Generate fallback avatar using UI Avatars
    $name = urlencode($firstName . '+' . $lastName);
    return "https://ui-avatars.com/api/?name={$name}&size={$size}&background=f97316&color=fff&rounded=true";
}

/**
 * UPDATED: Legacy function for backward compatibility
 * @param object|array $user User object or array
 * @param int $size Size for the image
 * @return string Profile picture URL
 */
function getProfilePicture($user, $size = 150) {
    return getUserProfilePicture($user, $size);
}

/**
 * Get profile picture for attendees (specific function for events)
 * @param object $attendee Attendee object
 * @param int $size Size for the image
 * @return string Profile picture URL
 */
function getProfilePictureUrl($attendee, $size = 150) {
    return getUserProfilePicture($attendee, $size);
}

/**
 * Get activity icon based on activity type
 * @param string $activityType Type of activity
 * @return string Font Awesome icon class
 */
function getActivityIcon($activityType) {
    $icons = [
        'event_created' => 'fas fa-calendar-plus',
        'review_posted' => 'fas fa-star',
        'user_joined' => 'fas fa-user-plus',
        'event_joined' => 'fas fa-calendar-check',
        'friendship_created' => 'fas fa-user-friends'
    ];
    
    return $icons[$activityType] ?? 'fas fa-bell';
}

/**
 * Get activity color based on activity type
 * @param string $activityType Type of activity
 * @return string CSS color class
 */
function getActivityColor($activityType) {
    $colors = [
        'event_created' => 'text-blue-500',
        'review_posted' => 'text-yellow-500',
        'user_joined' => 'text-green-500',
        'event_joined' => 'text-purple-500',
        'friendship_created' => 'text-pink-500'
    ];
    
    return $colors[$activityType] ?? 'text-gray-500';
}

/**
 * Create a notification for a user
 * @param int $userId The user to notify
 * @param string $type The notification type
 * @param int $relatedId The ID of the related entity (event_id, user_id, etc.)
 * @param string $content The notification message
 * @return bool Success status
 */
function createNotification($userId, $type, $relatedId, $content) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        $query = "INSERT INTO notifications (user_id, type, related_id, content) VALUES (:user_id, :type, :related_id, :content)";
        $params = [
            'user_id' => $userId,
            'type' => $type,
            'related_id' => $relatedId,
            'content' => $content
        ];
        
        $result = $db->query($query, $params);
        return $result !== false;
    } catch (Exception $e) {
        error_log("Error creating notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create event invitation notification
 * @param int $userId User to invite
 * @param int $eventId Event ID
 * @param int $inviterId User who sent the invitation
 * @return bool
 */
function createEventInvitationNotification($userId, $eventId, $inviterId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        // Get event and inviter details
        $eventQuery = "SELECT title FROM events WHERE event_id = :event_id";
        $event = $db->query($eventQuery, ['event_id' => $eventId])->fetch();
        
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
        $inviter = $db->query($userQuery, ['user_id' => $inviterId])->fetch();
        
        if ($event && $inviter) {
            $content = "{$inviter->first_name} {$inviter->last_name} invited you to \"{$event->title}\"";
            return createNotification($userId, 'event_invitation', $eventId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating event invitation notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create friend request notification
 * @param int $userId User to notify
 * @param int $requesterId User who sent the request
 * @return bool
 */
function createFriendRequestNotification($userId, $requesterId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
        $requester = $db->query($userQuery, ['user_id' => $requesterId])->fetch();
        
        if ($requester) {
            $content = "{$requester->first_name} {$requester->last_name} sent you a friend request";
            return createNotification($userId, 'friend_request', $requesterId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating friend request notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create new attendee notification
 * @param int $hostId Event host to notify
 * @param int $eventId Event ID
 * @param int $attendeeId User who joined
 * @return bool
 */
function createNewAttendeeNotification($hostId, $eventId, $attendeeId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        // Get event and attendee details
        $eventQuery = "SELECT title FROM events WHERE event_id = :event_id";
        $event = $db->query($eventQuery, ['event_id' => $eventId])->fetch();
        
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
        $attendee = $db->query($userQuery, ['user_id' => $attendeeId])->fetch();
        
        if ($event && $attendee) {
            $content = "{$attendee->first_name} {$attendee->last_name} joined your event \"{$event->title}\"";
            return createNotification($hostId, 'new_attendee', $eventId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating new attendee notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create new review notification
 * @param int $userId User to notify (who received the review)
 * @param int $eventId Event ID
 * @param int $reviewerId User who wrote the review
 * @return bool
 */
function createNewReviewNotification($userId, $eventId, $reviewerId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        // Get event and reviewer details
        $eventQuery = "SELECT title FROM events WHERE event_id = :event_id";
        $event = $db->query($eventQuery, ['event_id' => $eventId])->fetch();
        
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
        $reviewer = $db->query($userQuery, ['user_id' => $reviewerId])->fetch();
        
        if ($event && $reviewer) {
            $content = "{$reviewer->first_name} {$reviewer->last_name} left a review for your event \"{$event->title}\"";
            return createNotification($userId, 'new_review', $eventId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating new review notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create event reminder notification
 * @param int $userId User to notify
 * @param int $eventId Event ID
 * @return bool
 */
function createEventReminderNotification($userId, $eventId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        $eventQuery = "SELECT title, event_date, start_time FROM events WHERE event_id = :event_id";
        $event = $db->query($eventQuery, ['event_id' => $eventId])->fetch();
        
        if ($event) {
            $content = "Reminder: \"{$event->title}\" starts tomorrow at " . date('H:i', strtotime($event->start_time));
            return createNotification($userId, 'event_reminder', $eventId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating event reminder notification: " . $e->getMessage());
        return false;
    }
}

/**
 * Create new message notification
 * @param int $userId User to notify
 * @param int $senderId User who sent the message
 * @param int $messageId Message ID
 * @return bool
 */
function createNewMessageNotification($userId, $senderId, $messageId) {
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = :user_id";
        $sender = $db->query($userQuery, ['user_id' => $senderId])->fetch();
        
        if ($sender) {
            $content = "{$sender->first_name} {$sender->last_name} sent you a new message";
            return createNotification($userId, 'new_message', $messageId, $content);
        }
        
        return false;
    } catch (Exception $e) {
        error_log("Error creating new message notification: " . $e->getMessage());
        return false;
    }
}
/**
 * Get notification count for current user
 * @return int
 */
function getNotificationCount() {
    if (!isset($_SESSION['user_id'])) {
        return 0;
    }
    
    try {
        $config = require basePath('config/db.php');
        $db = new Framework\Database($config['database']);
        
        $query = "SELECT COUNT(*) as count FROM notifications WHERE user_id = :user_id AND is_read = 0";
        $params = ['user_id' => $_SESSION['user_id']];
        $result = $db->query($query, $params)->fetch();
        
        return $result->count ?? 0;
    } catch (Exception $e) {
        error_log("Error getting notification count: " . $e->getMessage());
        return 0;
    }
}

/**
 * Format notification badge count
 * @param int $count
 * @return string
 */
function formatNotificationBadge($count) {
    if ($count == 0) {
        return '';
    } elseif ($count > 99) {
        return '99+';
    } else {
        return (string)$count;
    }
}
