/**
 * Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	//var m = location.search.match(/[&?]skin=([\w-]+)/);
	// config.skin = m ? m[1] : 'moono-light';
	config.skin = 'moono-light';
	  
	config.filebrowserBrowseUrl = 'http://localhost/ckeditor/asset/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = 'http://localhost/ckeditor/asset/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 'http://localhost/ckeditor/asset/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = 'http://localhost/ckeditor/asset/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = 'http://localhost/ckeditor/asset/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 'http://localhost/ckeditor/asset/kcfinder/upload.php?type=flash';
};

