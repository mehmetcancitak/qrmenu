function autoSystemMessage(data='')
{
    if(data!=''){
        for (let i = 0; i < data.length; i++) {
            switch (data[i]){
                case 'UPDATE_1': 
                toastr.success("Güncelleme Başarılı Şekilde Kaydedildi.");
                break;

                case 'UPDATE_ERROR': 
                toastr.success("Güncelleme yapılırken hata alındı.");
                break;

                case 'OLD_PASSWORD_NOT_MATCH':
                toastr.warning("Eski Şifre Hatalı.");
                break;


                case 'AT_LEAST_EIGHT_CHARACTERS':
                toastr.info("Şifre 8 Karakterden Küçük Olamaz.");
                break;

                case 'PASSWORDS_DO_NOT_MATCH':
                toastr.warning("Şifreler Eşleşmiyor.");
                break;

                case 'PREVIOUSLY_USERNAME_TAKEN':
                toastr.warning("Kullanıcı Adı Daha Önceden Alınmış");
                break;

                case 'PREVIOUSLY_MAIL_TAKEN':
                toastr.warning("Mail Daha Önceden Alınmış");
                break;

                case 'US_ID_NUMBER_IN':
                toastr.warning("Kullanıcı adı tanımlara uymamaktadır.Lütfen tekrar kontrol ediniz.");
                break;

                //Success , insert , başarılı
                case 'SUCCESSFULLY_ADDED':
                toastr.success("Başarılı şekilde eklendi.");
                break;

                case 'EMAIL_INVALID':
                toastr.warning("Mail kurallara uymamaktadır.");
                break;

                case 'NOT_NULL':
                toastr.warning("* İle İşaretli Alanların Doldurulması Zorunludur.");
                break;

                case 'SYSTEM_ERROR':
                toastr.warning("Sistem Hatası.Site Sahibi ile iletişime geçiniz.");
                break;

                case 'DELETE_ERROR':
                toastr.warning("Silerken Hata Oluştu");

                case 'DELETE_SUCCESS':
                toastr.success("Silme işlemi başarılı şekilde tamamlandı.");

                default: 
                console.log("Bilinmeyen Hata.");
            }   
        }
    }
}