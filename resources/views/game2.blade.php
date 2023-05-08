<!DOCTYPE html>
<html>
<head>
	<title>Snake Game</title>
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

// Snake
let snake = [
	{x: 10, y: 10},
	{x: 20, y: 10},
	{x: 30, y: 10},
	{x: 40, y: 10}
];

let dx = 10;
let dy = 0;

// Food
let food = {
	x: Math.floor(Math.random() * canvas.width/10) * 10,
	y: Math.floor(Math.random() * canvas.height/10) * 10
};

// Controls
document.addEventListener('keydown', function(event) {
	if (event.code === 'ArrowUp' && dy !== 10) {
		dx = 0;
		dy = -10;
	}
	if (event.code === 'ArrowDown' && dy !== -10) {
		dx = 0;
		dy = 10;
	}
	if (event.code === 'ArrowRight' && dx !== -10) {
		dx = 10;
		dy = 0;
	}
	if (event.code === 'ArrowLeft' && dx !== 10) {
		dx = -10;
		dy = 0;
	}
});

// Update snake position
function updateSnake() {
	// Update snake body
	for (let i = snake.length - 1; i > 0; i--) {
		snake[i].x = snake[i-1].x;
		snake[i].y = snake[i-1].y;
	}

	// Update snake head
	snake[0].x += dx;
	snake[0].y += dy;

	// Wrap snake around screen
	if (snake[0].x < 0) {
		snake[0].x = canvas.width - 10;
	}
	if (snake[0].x > canvas.width - 10) {
		snake[0].x = 0;
	}
	if (snake[0].y < 0) {
		snake[0].y = canvas.height - 10;
	}
	if (snake[0].y > canvas.height - 10) {
		snake[0].y = 0;
	}

	// Check collision with food
	if (snake[0].x === food.x && snake[0].y === food.y) {
		snake.push({x: snake[snake.length-1].x, y: snake[snake.length-1].y});
		food.x = Math.floor(Math.random() * canvas.width/10) * 10;
		food.y = Math.floor(Math.random() * canvas.height/10) * 10;
	}

	// Check collision with own body
	for (let i = 1; i < snake.length; i++) {
		if (snake[0].x === snake[i].x && snake[0].y === snake[i].y) {
			alert('Game Over!');
			location.reload();
		}
	}

	// Draw snake
	ctx.fillStyle = '#00f';
	for (let i = 0; i < snake.length; i++) {
        ctx.fillRect(snake[i].x, snake[i].y, 10, 10);
    }

    // Draw food
    ctx.fillStyle = '#f00';
    ctx.fillRect(food.x, food.y, 10, 10);

}

// Game loop
function gameLoop() {
    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Update snake
    updateSnake();

    // Call game loop again
    requestAnimationFrame(gameLoop);
}

// Start game loop
gameLoop();
    </script>
</body>
</html>
