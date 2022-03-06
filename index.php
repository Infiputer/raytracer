
<canvas id="myCanvas" width="200" height="100" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.
</canvas>


<script>
var c = document.getElementById("myCanvas");

c.width = window.innerWidth - 20;
c.height = window.innerHeight - 30;
width = window.innerWidth - 20;
height = window.innerHeight - 30;

var ctx = c.getContext("2d");

lightsource = [50, 50]
me = [120, 50];
	
lightbeams = []
	
class lightbeam{
	constructor(x, y, energy, direction){
		this.x = x;
		this.y = y;
		this.direction = direction;
		this.energy = energy;
		this.lastbounce = -1;
	}
	update(){
		this.x+=Math.cos(this.direction)
		this.y+=Math.sin(this.direction)
		rect(this.x, this.y, 10, 10, "yellow")
	}
}

function rect(x, y, height, width, color){
	ctx.fillStyle = color;
	ctx.fillRect(x-width/2, y-height/2, width, height)
}
	
items = [[20, 20], [90, 70], [90, 200]]
const distance = (x0, y0, x1, y1) => Math.hypot(x1 - x0, y1 - y0);

function showGraphics(){
	ctx.clearRect(0, 0, width, height)
	for(itemindex in items){
		item = items[itemindex]
		rect(item[0], item[1], 20, 20, "#00a2e8")
	}
	rect(lightsource[0], lightsource[1], 20, 20, "orange");
	rect(me[0], me[1], 20, 20, "#00FF00");
	for(light=0;light<lightbeams.length;light++){
		lightbeams[light].update();
		for(itembounce in items){
			bounce = items[itembounce]
			console.log(lightbeams[light].lastbounce)
			if(
				(!(lightbeams[light].lastbounce==(itembounce))) &&
				distance(bounce[0], bounce[1], lightbeams[light].x, lightbeams[light].y)<20
			){
				lightbeams[light].lastbounce = itembounce;
				for(lightangle=-2;lightangle<2;lightangle=lightangle+0.6){
					console.log("hi")
					appendlightbeam = new lightbeam(
						lightbeams[light].x, 
						lightbeams[light].y, 
						20, Math.PI+lightbeams[light].direction+lightangle
					);
					appendlightbeam.lastbounce = itembounce;
					lightbeams.push(appendlightbeam)
				}
				console.log("break");
			}
		}
	}
}

setInterval(showGraphics, 100);

for(i=0;i<Math.PI*2;i+=0.3){
	lightbeams.push(new lightbeam(lightsource[0], lightsource[1], 20, i))
}
</script>