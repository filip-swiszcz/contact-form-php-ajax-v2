function validate() {
    
    
    var valid = true;
    
    
    var name = $("#name").val();
    var email = $("#email").val();
    var title = $("#title").val();
    var message = $("#message").val();
    
    
    if (name == '') {
        
        valid = false;
        
    }
    
    if (email == '') {
        
        valid = false;
        
    }
    
    if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        
        valid = false;
        
    }
    
    if (title == '') {
        
        valid = false;
        
    }
    
    if (message == '') {
        
        valid = false;
        
    }
    
    
    return valid;
    
}

$(function() {
    
    var form = $('#contact-form');
    var success = $('#success');
    var error = $('#error');
    
    $(form).submit(function(e) {
        
        e.preventDefault();
        
        var formData = $(this).serialize();
        var valid = validate();
        
        if (valid = true) {
            
            $.ajax({
                url: 'inc/ContactScript.php',
                type: 'POST',
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                
                success: function(response) {
                    if (response.type == 'message') {
                        
                        $(error).css('display', 'none');
                        $(success).css('display', 'block');
                        $(success).text(response.text);
                        $('#name').val('');
                        $('#email').val('');
                        $('#title').val('');
                        $('#message').val('');
                        setTimeout(function() {
                            $(success).fadeOut();
                        }, 5000);
                        
                    } else if (response.type == 'error') {
                        
                        $(success).css('display', 'none');
                        $(error).css('display', 'block');
                        $(error).text(response.text);
                        setTimeout(function() {
                            $(error).fadeOut();
                        }, 8000);
                        
                    } else {
                        
                        $(success).css('display', 'none');
                        $(error).css('display', 'block');
                        $(error).text('Error: Skontaktuj się przez email podany poniżej.');
                        setTimeout(function() {
                            $(error).fadeOut();
                        }, 8000);
                        
                    }
                },
                
                error: function(jqXHR, errorThrown) {
                    
                    var message = jqXHR.responseText;
                    
                    $(error).css('display', 'block');
                    $(error).text(message);
                    setTimeout(function() {
                        $(error).fadeOut();
                    }, 8000);
                    
                }
                
            });
            
        }
        
    });
    
});