var video, canvas, context, imageData, posit,detector
var renderer, scene, camera, model, texture

var step = 0.0
var mesh = null
var modelSize =  35.0 //millimeters
var container = document.getElementById('container')


function onLoad() {
  video = document.getElementById("video")
  video.width = 640;
  video.height = 480;
  canvas = document.createElement("canvas")
  canvas.width = parseInt(container.style.width)
  canvas.height = parseInt(container.style.height)
  canvas.id = 'bg'
  context = canvas.getContext("2d")
  container.appendChild(canvas)

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia
  if (navigator.getUserMedia) {
    init()
  }
}

async function init() {
	navigator.getUserMedia({ video: true },
	    function(stream) {
	      if (window.URL) {
	        video.src = window.URL.createObjectURL(stream)
	      } else if (video.mozSrcObject !== undefined) {
	        video.mozSrcObject = stream
	      } else {
	        video.src = stream
	      }
	    },
	    function(error) {
		alert('WebRTC not available')
	    }
	  )
  const net = await posenet.load();
  posit = new POS.Posit(modelSize, canvas.width)
  createRenderers()

  tick(net)
}

function tick(net) {

   async  function poseDetectionFrame() {
    snapshot()
    const imageScaleFactor = 0.5;
    const outputStride = 16;
    const flipHorizontal = true;

    const pose = await net.estimateSinglePose(video, imageScaleFactor, flipHorizontal, outputStride);

  //  console.log(pose);


    mesh.position.set(((640-pose.keypoints[0].position.x-320)/64),-(pose.keypoints[0].position.y/80),0)

    var s = (pose.keypoints[12].position.y-pose.keypoints[6].position.y)/300;
    s=Math.floor(s * 10) / 10  
    mesh.scale.set(s, s, s)

    var r = -(pose.keypoints[0].position.x-((pose.keypoints[5].position.x+pose.keypoints[6].position.x)/2))/20;
    r=Math.floor(r * 10) / 10 
    mesh.rotation.set(0,r,0)
 

    scene.add(mesh)

    renderer.render(scene, camera);
    requestAnimationFrame(poseDetectionFrame);
  }

   poseDetectionFrame();



}

function snapshot() {
  context.drawImage(video, 0, 0,  canvas.width, canvas.height)
  
}


var goods = null

function createRenderers() {
  renderer = new THREE.WebGLRenderer({
    antialias:true,
    alpha: true
  })

  renderer.setSize(640,480)

  renderer.domElement.id = 'goods'
  goods = renderer.domElement
  container.appendChild(renderer.domElement)

  renderer.setClearColor(0x000000, 0);

  scene = new THREE.Scene();
  camera = new THREE.OrthographicCamera(-5, 5, 3.75, -3.75, 0.1, 100);
  camera.position.set(0, 0, 25);
  camera.lookAt(new THREE.Vector3(0, 3.5, 0));
  scene.add(camera);

  var mtlLoader = new THREE.MTLLoader();
  mtlLoader.load('./img/456.mtl', function (material) {
	
  var loader = new THREE.OBJLoader();
  loader.setMaterials(material);
  loader.load("./img/456.obj", function(obj) {
    mesh = obj
    console.log('Iris')
     })
  })

    var light = new THREE.DirectionalLight(0xffffff)
    light.position.set(0, 0, 25)
    scene.add(light)
}



window.onload = onLoad