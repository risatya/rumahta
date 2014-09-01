/**
 * Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	//var m = location.search.match(/[&?]skin=([\w-]+)/);
	// config.skin = m ? m[1] : 'moono-light';
	config.skin = 'moono-light';
	  
	config.filebrowserBrowseUrl = 'http://rumahta.com/asset/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = 'http://rumahta.com/asset/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 'http://rumahta.com/asset/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = 'http://rumahta.com/asset/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = 'http://rumahta.com/asset/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 'http://rumahta.com/asset/kcfinder/upload.php?type=flash';
};

