<?php
$title = $title ?? 'SocialLoop';
loadPartial('scripts');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - SocialLoop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e5941d',
                        secondary: '#333',
                        lightbg: '#FFF1DA'
                    },
                    fontFamily: {
                        volkhov: ['"Volkhov"', 'serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <?php if (isset($customStyle)) echo $customStyle; ?>
</head>
<script>
         //ScrollDown Function
         document.addEventListener('DOMContentLoaded', () => {
        initHeaderScrollBehavior();  // Call only if this feature is needed
    });
    </script>