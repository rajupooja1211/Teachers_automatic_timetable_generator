function Sms(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Sms);

Sms.prototype.prepareForUpdate =  function(resource) {
    $('input[name=time]').val(resource.time);
    $('input[name=class]').val(resource.class);
    $('input[name=subject]').val(resource.subject);
};

window.addEventListener('load', function(){
    var sms = new Sms('/sms', 'Timeslot');
    sms.init();
});