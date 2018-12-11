function image_slider(delay){
	this.image = $('.image_slider span').get();
	this.length = this.image.length;	
	
	this.counter = 0;
	this.cek_counter = 0;
	
	this.select = 'off';
	
	this.li_active = 1;
	this.li_inactive = 0;
	
	if(delay == undefined || delay == '')
		this.img_timeOut = 4000;				

	$('.image_slider').html("<div class='base'></div>");
	$('.image_slider').append("<div class='selector'></div>");
	$('.image_slider div.base').append("<div class='img_pad'></div> <div class='list_pad'></div>");
	
	for(i=1;i<=this.length;i++)
		$('.selector').append("<div id='li_" + i + "' class='li_inactive'>" + i + "</div>");
	
	this.check = function(){				
		
		if(this.cek_counter == 7000 && this.select == 'off'){
			if(this.counter >= this.length){
				this.counter = 0;
			}
			
			this.li_inactive = this.li_active;
			this.li_active = this.counter + 1;
			
			this.cek_counter = 0;
			this.start();
			
			$('.img_pad').delay(5500).fadeOut(500);
			return;
		}
		else if(this.select == 'on'){
			this.li_inactive = this.li_active;
			this.li_active = this.counter + 1;

			this.cek_counter = 0;
			this.select = 'off';					
			this.start();
			return;
		}
			
		this.cek_counter += 1000;
		setTimeout(function(images_slider){images_slider.check();},1000,this);
	}
	
	this.func_select = function(id){
		this.select = "on";
		this.counter = id - 1;
	}
	
	this.start = function(){				
		var index_img = this.li_active - 1;
		
		var img = this.image[index_img].innerHTML;
		
		$('.img_pad').hide();
		$('.img_pad').html(img);
		
		$('.img_pad').fadeIn(500);				
						
		if(this.counter == 0)
			b = this.length;
		
		$('#li_' + this.li_active).attr('class','li_active');
		$('#li_' + this. li_inactive).attr('class','li_inactive');
						
		this.counter++;
		this.check();
	}
}