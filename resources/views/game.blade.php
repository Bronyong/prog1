<!DOCTYPE html>
<html>
<head>
	<title>My Game</title>
	<style>
		canvas {
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<canvas id="canvas" width="480" height="320"></canvas>
	{{-- <script src="game.js"></script> --}}


    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        // Player
        const player = {
            x: 50,
            y: 200,
            width: 32,
            height: 64,
            dx: 0,
            dy: 0,
            jumping: false
        };

        // Controls
        document.addEventListener('keydown', function(event) {
            if (event.code === 'ArrowUp' && !player.jumping) {
                player.dy = -10;
                player.jumping = true;
            }
            if (event.code === 'ArrowRight') {
                player.dx = 5;
            }
            if (event.code === 'ArrowLeft') {
                player.dx = -5;
            }
        });

        document.addEventListener('keyup', function(event) {
            if (event.code === 'ArrowRight') {
                player.dx = 0;
            }
            if (event.code === 'ArrowLeft') {
                player.dx = 0;
            }
        });

        // Platforms
        const platformWidth = 80;
        const platformHeight = 16;
        const platformColor = '#333';
        const platforms = [
            {x: canvas.width/2 - platformWidth/2, y: 250},
            {x: 50, y: 150},
            {x: canvas.width - 130, y: 100}
        ];

        // Update player position
        function updatePlayer() {
            // Apply gravity
            player.dy += 0.5;

            // Update player position
            player.x += player.dx;
            player.y += player.dy;

            // Check collision with platforms
            for (let i = 0; i < platforms.length; i++) {
                let p = platforms[i];
                if (player.x + player.width > p.x && player.x < p.x + platformWidth && player.y + player.height > p.y && player.y < p.y + platformHeight) {
                    player.dy = 0;
                    player.jumping = false;
                    player.y = p.y - player.height;
                    break;
                }
            }

            // Draw player
            ctx.fillStyle = '#f00';
            ctx.fillRect(player.x, player.y, player.width, player.height);
        }

        // Draw platforms
        function drawPlatforms() {
            ctx.fillStyle = platformColor;
            for (let i = 0; i < platforms.length; i++) {
                let p = platforms[i];
                ctx.fillRect(p.x, p.y, platformWidth, platformHeight);
            }
        }

        // Game loop
        function gameLoop() {
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Update player position
            updatePlayer();

            // Draw platforms
            drawPlatforms();

            // Call gameLoop again
            requestAnimationFrame(gameLoop);
        }

        // Start game loop
        requestAnimationFrame(gameLoop);

    </script>
</body>
</html>
