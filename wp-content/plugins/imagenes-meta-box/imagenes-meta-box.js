jQuery(document).ready(function($) {
 
var addButton = document.getElementById( 'img_boton1' );
var deleteButton = document.getElementById( 'image-delete-button1' );
var hidden = document.getElementById( 'em_mtbx_img1' );
var img = document.getElementById( 'image-tag1' );
var aux = document.getElementById( 'aux_img1' );
var srcimages = aux.getAttribute("value");
console.log(srcimages);
console.log(img.getAttribute("src"));
var pp=10;
pp=img.getAttribute("src").localeCompare("http://localhost/SC/wp-content/themes/theme-servicioComunitario/img/no-hay-imagen.jpg");

var customUploader = wp.media({
    title: 'Seleccione una imagen',
    button: {
        text: 'Usar esta imagen'
    },
    multiple: false
});

addButton.addEventListener( 'click', function() {
    if ( customUploader ) {
        customUploader.open();
    }
} );

deleteButton.addEventListener( 'click', function() {
    img.removeAttribute( 'src' );
    img.setAttribute( 'src', srcimages );
    hidden.removeAttribute( 'value' );
    toggleVisibility( 'DELETE' );
} );


customUploader.on( 'select', function() {
    var attachment = customUploader.state().get('selection').first().toJSON();
    img.setAttribute( 'src', attachment.url );
    hidden.setAttribute( 'value', attachment.url );
    toggleVisibility( 'ADD' );
} );

var toggleVisibility = function( action ) {
    if ( 'ADD' === action ) {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
        img.setAttribute( 'style', 'width: 200px; height: 200px;');
    }

    if ( 'DELETE' === action ) {
        addButton.style.display = '';
        deleteButton.style.display = 'none';
        img.removeAttribute('style');
    }
    
};

  if(pp!=0)
    {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
    }

});

jQuery(document).ready(function($) {
 
var addButton = document.getElementById( 'img_boton2' );
var deleteButton = document.getElementById( 'image-delete-button2' );
var hidden = document.getElementById( 'em_mtbx_img2' );
var img = document.getElementById( 'image-tag2' );
var aux = document.getElementById( 'aux_img2' );
var srcimages = aux.getAttribute("value");
var pp=10;
pp=img.getAttribute("src").localeCompare("http://localhost/SC/wp-content/themes/theme-servicioComunitario/img/no-hay-imagen.jpg");

var customUploader = wp.media({
    title: 'Seleccione una imagen',
    button: {
        text: 'Usar esta imagen'
    },
    multiple: false
});

addButton.addEventListener( 'click', function() {
    if ( customUploader ) {
        customUploader.open();
    }
} );

deleteButton.addEventListener( 'click', function() {
    img.removeAttribute( 'src' );
    img.setAttribute( 'src', srcimages );
    hidden.removeAttribute( 'value' );
    toggleVisibility( 'DELETE' );
} );


customUploader.on( 'select', function() {
    var attachment = customUploader.state().get('selection').first().toJSON();
    img.setAttribute( 'src', attachment.url );
    hidden.setAttribute( 'value', attachment.url );
    toggleVisibility( 'ADD' );
} );

var toggleVisibility = function( action ) {
    if ( 'ADD' === action ) {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
        img.setAttribute( 'style', 'width: 200px; height: 200px;');
    }

    if ( 'DELETE' === action ) {
        addButton.style.display = '';
        deleteButton.style.display = 'none';
        img.removeAttribute('style');
    }
};

  if(pp!=0)
    {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
    }
});

jQuery(document).ready(function($) {
 
var addButton = document.getElementById( 'img_boton3' );
var deleteButton = document.getElementById( 'image-delete-button3' );
var hidden = document.getElementById( 'em_mtbx_img3' );
var img = document.getElementById( 'image-tag3' );
var aux = document.getElementById( 'aux_img3' );
var srcimages = aux.getAttribute("value");
var pp=10;
pp=img.getAttribute("src").localeCompare("http://localhost/SC/wp-content/themes/theme-servicioComunitario/img/no-hay-imagen.jpg");

var customUploader = wp.media({
    title: 'Seleccione una imagen',
    button: {
        text: 'Usar esta imagen'
    },
    multiple: false
});

addButton.addEventListener( 'click', function() {
    if ( customUploader ) {
        customUploader.open();
    }
} );

deleteButton.addEventListener( 'click', function() {
    img.removeAttribute( 'src' );
    img.setAttribute( 'src', srcimages );
    hidden.removeAttribute( 'value' );
    toggleVisibility( 'DELETE' );
} );


customUploader.on( 'select', function() {
    var attachment = customUploader.state().get('selection').first().toJSON();
    img.setAttribute( 'src', attachment.url );
    hidden.setAttribute( 'value', attachment.url );
    toggleVisibility( 'ADD' );
} );

var toggleVisibility = function( action ) {
    if ( 'ADD' === action ) {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
        img.setAttribute( 'style', 'width: 200px; height: 200px;');
    }

    if ( 'DELETE' === action ) {
        addButton.style.display = '';
        deleteButton.style.display = 'none';
        img.removeAttribute('style');
    }
};

  if(pp!=0)
    {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
    }
});

jQuery(document).ready(function($) {
 
var addButton = document.getElementById( 'img_boton4' );
var deleteButton = document.getElementById( 'image-delete-button4' );
var hidden = document.getElementById( 'em_mtbx_img4' );
var img = document.getElementById( 'image-tag4' );
var aux = document.getElementById( 'aux_img4' );
var srcimages = aux.getAttribute("value");
var pp=10;
pp=img.getAttribute("src").localeCompare("http://localhost/SC/wp-content/themes/theme-servicioComunitario/img/no-hay-imagen.jpg");

var customUploader = wp.media({
    title: 'Seleccione una imagen',
    button: {
        text: 'Usar esta imagen'
    },
    multiple: false
});

addButton.addEventListener( 'click', function() {
    if ( customUploader ) {
        customUploader.open();
    }
} );

deleteButton.addEventListener( 'click', function() {
    img.removeAttribute( 'src' );
    img.setAttribute( 'src', srcimages );
    hidden.removeAttribute( 'value' );
    toggleVisibility( 'DELETE' );
} );


customUploader.on( 'select', function() {
    var attachment = customUploader.state().get('selection').first().toJSON();
    img.setAttribute( 'src', attachment.url );
    hidden.setAttribute( 'value', attachment.url );
    toggleVisibility( 'ADD' );
} );

var toggleVisibility = function( action ) {
    if ( 'ADD' === action ) {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
        img.setAttribute( 'style', 'width: 200px; height: 200px;');
    }

    if ( 'DELETE' === action ) {
        addButton.style.display = '';
        deleteButton.style.display = 'none';
        img.removeAttribute('style');
    }
};

  if(pp!=0)
    {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
    }
});

jQuery(document).ready(function($) {
 
var addButton = document.getElementById( 'img_boton5' );
var deleteButton = document.getElementById( 'image-delete-button5' );
var hidden = document.getElementById( 'em_mtbx_img5' );
var img = document.getElementById( 'image-tag5' );
var aux = document.getElementById( 'aux_img5' );
var srcimages = aux.getAttribute("value");
var pp=10;
pp=img.getAttribute("src").localeCompare("http://localhost/SC/wp-content/themes/theme-servicioComunitario/img/no-hay-imagen.jpg");

var customUploader = wp.media({
    title: 'Seleccione una imagen',
    button: {
        text: 'Usar esta imagen'
    },
    multiple: false
});

addButton.addEventListener( 'click', function() {
    if ( customUploader ) {
        customUploader.open();
    }
} );

deleteButton.addEventListener( 'click', function() {
    img.removeAttribute( 'src' );
    img.setAttribute( 'src', srcimages );
    hidden.removeAttribute( 'value' );
    toggleVisibility( 'DELETE' );
} );


customUploader.on( 'select', function() {
    var attachment = customUploader.state().get('selection').first().toJSON();
    img.setAttribute( 'src', attachment.url );
    hidden.setAttribute( 'value', attachment.url );
    toggleVisibility( 'ADD' );
} );

var toggleVisibility = function( action ) {
    if ( 'ADD' === action ) {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
        img.setAttribute( 'style', 'width: 200px; height: 200px;');
    }

    if ( 'DELETE' === action ) {
        addButton.style.display = '';
        deleteButton.style.display = 'none';
        img.removeAttribute('style');
    }
};

  if(pp!=0)
    {
        addButton.style.display = 'none';
        deleteButton.style.display = '';
    }
});

