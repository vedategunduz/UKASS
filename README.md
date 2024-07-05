# U.K.A.S.S. (Uzaktan Kontrollü Akıllı Sera Sistemi)

İsmininden de anlaşılacağı üzere, seranın sulanmasını, havalandırmasını uzaktan yapılabilir kılmak ve ortam sıcaklığı, toprak nemi, sulamak için kullanılacak suyun ne kadar kaldığı gibi değerleri web sitesi üzerinden görmek amacıyla geliştirilmiştir.

## İçindekiler

- [Hakkında](#hakkında)
- [Kurulum](#kurulum)
- [Devre Şeması](#devreseması)
- [Kullanım](#kullanım)
- [Özellikler](#özellikler)
- [Gereksinimler](#gereksinimler)
- [Katkıda Bulunma](#katkıda-bulunma)
- [Lisans](#lisans)
- [İletişim](#iletişim)

## Hakkında

U.K.A.S.S. (Uzaktan Kontrollü Akıllı Sera Sistemi), seranın otomatik olarak sulanmasını ve havalandırılmasını sağlamak amacıyla geliştirilmiştir. Aynı zamanda, ortam sıcaklığı, toprak nemi ve su seviyesini web sitesi üzerinden takip etmeyi mümkün kılar.

NodeMCU, internete bağlanarak verileri web sunucusuna gönderir ve bu veriler bir web sitesi üzerinden görüntülenir.

## Kurulum

Projeyi kurmak için aşağıdaki adımları izleyin:

## Devre Şeması

DEVRE ŞEMASI

### Gerekli Malzemeler
- NodeMCU
- LCD Ekran
- Arduino
- NTC
- Su sensörü
- Toprak nem sensörü
- Fan
- Arduino için su motoru
- 2 Adet Röle

### Adımlar
1. Gerekli malzemeleri temin edin.
2. Malzemeleri belirtilen şemaya göre bağlayın.
3. [Projede kullanılan kodları](link) Arduino ve NodeMCU'ya yükleyin.
4. Web sunucusunu kurarak dosyalarını yükleyin.
5. NodeMCU'yu internete bağlayın ve verilerin web sunucusuna gönderildiğinden emin olun.

## Kullanım

Projeyi kullanmak için:
1. Sistemi güç kaynağına bağlayın.
2. Web arayüzü üzerinden sisteme bağlanın.
3. Ortam sıcaklığı, toprak nemi ve su seviyesini takip edin.
4. İhtiyaca göre sulama ve havalandırma işlemlerini uzaktan kontrol edin.

## Özellikler

- Uzaktan kontrol edilebilirlik.
- Ortam sıcaklığı, toprak nemi ve su seviyesinin izlenmesi.
- Otomatik sulama ve havalandırma.
- Verilerin web sunucusuna gönderilmesi ve web sitesinde görüntülenmesi.

## Gereksinimler

- Arduino IDE
- NodeMCU
- PHP destekli bir web sunucusu
- İnternet bağlantısı

## Katkıda Bulunma

Projeye katkıda bulunmak isterseniz, lütfen bir pull request oluşturun veya projeyle ilgili sorunları [issue tracker](https://github.com/vedat/ukass/issues) üzerinden bildirin.

## Lisans

Bu proje MIT Lisansı ile lisanslanmıştır. Detaylar için `LICENSE` dosyasına bakabilirsiniz.

## İletişim

Sorularınız için [vedat.bilisim@outlook.com](mailto:vedat.bilisim@outlook.com) adresine e-posta gönderebilirsiniz.
