/**
 * Created by Antis on 26.11.2016.
 */
$(function(){
    $(document).on('click', '.showModalButton', function(){
        console.log('click');
        $('#modalContent').load($(this).attr('value'));
        //dynamiclly set the header for the modal
        $('#modalHeader').find('h2').text(
            $(this).attr('title')
        );
    });
});
$(function(){
    $(document).on('click', '.get-consultation', function(){
        $('#consultation').load($(this).attr('value'));
        //dynamiclly set the header for the modal
        $('#consultation-modal-header').find('h2').text(
            $(this).attr('title')
        );
    });
//$('.get-consultation').css('background','black');
});
