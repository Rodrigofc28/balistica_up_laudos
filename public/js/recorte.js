var imgs = []; // Array de variáveis globais para as imagens
var imgS = $('#imagemCantoSuperior');
var imgF = $('#imagemCantoInferior');
var imgNs = $('#imagemNumSerie');

// Array de variáveis para controlar o corte
var isCropping = [];
var startX = [], startY = [], endX = [], endY = [];

$(document).ready(function() {
  function updateCanvasSize() {
    var canvasElements = $('.canvas');

    canvasElements.each(function(index, element) {
      var canvas = $(element)[0];
      var rect = canvas.getBoundingClientRect();
      canvas.width = rect.width;
      canvas.height = rect.height;

      var ctx = canvas.getContext('2d');
      if (imgs[index]) {
        ctx.drawImage(imgs[index], 0, 0, canvas.width, canvas.height); // Desenha a imagem original no canvas
        if (isCropping[index]) {
          drawSelectionBox(ctx, startX[index], startY[index], endX[index], endY[index]);
        }
      }
    });
  }

  $(window).on('resize', updateCanvasSize);

  $('.image-upload').on('change', function(e) {
    var index = $(this).index('.image-upload');
    var canvas = $('.canvas').eq(index)[0];

    var ctx = canvas.getContext('2d');
    var reader = new FileReader();

    reader.onload = function(event) {
      imgs[index] = new Image(); // Atribui a imagem ao array de variáveis globais

      imgs[index].onload = function() {
        updateCanvasSize(); // Atualiza o tamanho do canvas para se ajustar à tela
        if (index === 0) {
          imgS.val(canvas.toDataURL());
        } else if (index === 1) {
          imgF.val(canvas.toDataURL());
        } else if (index === 2) {
          imgNs.val(canvas.toDataURL());
        } else {
          // Se index for maior do que 2, significa que não corresponde a nenhum input específico
          // Nesse caso, atribua o URL de dados às variáveis correspondentes
        }
      };

      imgs[index].src = event.target.result;
    };

    reader.readAsDataURL(e.target.files[0]);
  });

  $('.canvas').on('mousedown', function(e) {
    var index = $(this).index('.canvas');
    isCropping[index] = true;
    startX[index] = e.pageX - $(this).offset().left;
    startY[index] = e.pageY - $(this).offset().top;
  });

  $('.canvas').on('mousemove', function(e) {
    var index = $(this).index('.canvas');
    if (isCropping[index]) {
      var canvas = $('.canvas').eq(index)[0];
      var ctx = canvas.getContext('2d');
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(imgs[index], 0, 0, canvas.width, canvas.height);
      drawSelectionBox(ctx, startX[index], startY[index], e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
    }
  });

  $('.canvas').on('mouseup', function(e) {
    var index = $(this).index('.canvas');
    if (isCropping[index]) {
      isCropping[index] = false;
      endX[index] = e.pageX - $(this).offset().left;
      endY[index] = e.pageY - $(this).offset().top;
      performCrop(index);
    }
  });

  function drawSelectionBox(ctx, x1, y1, x2, y2) {
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.rect(x1, y1, x2 - x1, y2 - y1);
    ctx.stroke();
  }

  function performCrop(index) {
    var canvas = $('.canvas').eq(index)[0];
    var ctx = canvas.getContext('2d');

    var x = Math.min(startX[index], endX[index]);
    var y = Math.min(startY[index], endY[index]);
    var width = Math.abs(startX[index] - endX[index]);
    var height = Math.abs(startY[index] - endY[index]);

    var croppedImage = ctx.getImageData(x, y, width, height);

    canvas.width = width;
    canvas.height = height;

    ctx.putImageData(croppedImage, 0, 0);

    var croppedDataURL = canvas.toDataURL();

    // Atribua o URL de dados aos inputs correspondentes
    if (index === 0) {
      imgS.val(croppedDataURL);
    } else if (index === 1) {
      imgF.val(croppedDataURL);
    } else if (index === 2) {
      imgNs.val(croppedDataURL);
    } else {
      // Se index for maior do que 2, significa que não corresponde a nenhum input específico
      // Nesse caso, atribua o URL de dados às variáveis correspondentes
    }
  }
});

