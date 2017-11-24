function annulus(parent,precent) {
					if (precent > 50) {
						parent.find('.annulus2').css('transform', "rotate(" + (precent * 3.6 - 180) + "deg)");
						parent.find('.annulus1').css('transform', "rotate(" + 180 + "deg)");
					} else {
						parent.find('.annulus1').css('transform', "rotate(" + precent * 3.6 + "deg)");
						parent.find('.annulus2').css('transform', "rotate(" + 0 + "deg)");
					}

				}