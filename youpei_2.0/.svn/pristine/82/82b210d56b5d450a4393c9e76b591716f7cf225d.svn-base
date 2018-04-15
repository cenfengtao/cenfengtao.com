for(var i=0; i<weekLen-1 ;i++){
			    		if(weekArray[i].class_time){
			    			var class_start_hour=weekArray[i].class_time[0].class_start_hour;
			    			class_start_hour=class_start_hour.substr(0,2);
			    			if(class_start_hour.substr(0,1)==0){
			    				class_start_hour=class_start_hour.slice(1)
			    			}
			    			var class_end_hour=weekArray[i].class_time[0].class_end_hour;
			    			class_end_hour=class_end_hour.substr(0,2);
			    			if(class_end_hour.substr(0,1)==0){
			    				class_end_hour=class_end_hour.slice(1)
			    			}
			    			if(class_start_hour>=9&class_start_hour<12){
			    				$(".first td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_start_hour>=12&class_start_hour<15){
			    				$(".second td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_start_hour>=15&class_start_hour<18){
			    				$(".third td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_start_hour>=18&class_start_hour<21){
			    				$(".fourth td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_end_hour>=9&class_end_hour<12){
			    				$(".first td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_end_hour>=12&class_end_hour<15){
			    				$(".second td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_end_hour>=15&class_end_hour<18){
			    				$(".third td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    			if(class_end_hour>=18&class_end_hour<21){
			    				$(".fourth td").eq(i+1).html('<a href="###" class="ke">课</a>')
			    			}
			    		}else{
			    			$(".first td").eq(i+1).html("")
			    			$(".second td").eq(i+1).html("")
			    			$(".third td").eq(i+1).html("")
			    			$(".fourth td").eq(i+1).html("")
			    		}
			    	}