<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Common process steps for all services
        $commonProcess = [
            [
                'title_ru' => 'Брифинг и анализ',
                'title_en' => 'Briefing and analysis',
                'title_az' => 'Brifinq və analiz',
                'description_ru' => 'Встречаемся, изучаем ваши цели, бюджет, корпоративную культуру и ожидания от мероприятия',
                'description_en' => 'We meet, study your goals, budget, corporate culture and event expectations',
                'description_az' => 'Görüşürük, məqsədlərinizi, büdcənizi, korporativ mədəniyyətinizi və tədbirdən gözləntilərizi öyrənirik',
            ],
            [
                'title_ru' => 'Концепция и презентация',
                'title_en' => 'Concept and presentation',
                'title_az' => 'Konsepsiya və təqdimat',
                'description_ru' => 'Разрабатываем уникальную концепцию, подбираем площадку, формируем смету',
                'description_en' => 'We develop a unique concept, select a venue, create an estimate',
                'description_az' => 'Unikal konsepsiya hazırlayırıq, məkan seçirik, smeta formalaşdırırıq',
            ],
            [
                'title_ru' => 'Подготовка',
                'title_en' => 'Preparation',
                'title_az' => 'Hazırlıq',
                'description_ru' => 'Координируем всех подрядчиков, контролируем брендирование, технику, кейтеринг',
                'description_en' => 'We coordinate all contractors, control branding, equipment, catering',
                'description_az' => 'Bütün podratçıları koordinasiya edirik, brendinq, texnika, keyterinqə nəzarət edirik',
            ],
            [
                'title_ru' => 'Проведение',
                'title_en' => 'Execution',
                'title_az' => 'Keçirilmə',
                'description_ru' => 'Наша команда на площадке обеспечивает безупречное проведение мероприятия',
                'description_en' => 'Our team on site ensures flawless event execution',
                'description_az' => 'Komandamız məkanda tədbirin qüsursuz keçirilməsini təmin edir',
            ],
            [
                'title_ru' => 'Отчётность',
                'title_en' => 'Reporting',
                'title_az' => 'Hesabat',
                'description_ru' => 'Предоставляем фото/видео материалы и детальный отчёт по мероприятию',
                'description_en' => 'We provide photo/video materials and a detailed event report',
                'description_az' => 'Foto/video materialları və tədbir üzrə ətraflı hesabat təqdim edirik',
            ],
        ];

        // Corporate events pricing
        $corporatePricing = [
            [
                'name_ru' => 'Стартовый',
                'name_en' => 'Starter',
                'name_az' => 'Başlanğıc',
                'guests_ru' => 'До 50 гостей',
                'guests_en' => 'Up to 50 guests',
                'guests_az' => '50 qonaqa qədər',
                'price' => '2000',
                'is_featured' => false,
                'features_ru' => "Разработка концепции\nПодбор площадки\nБазовый декор\nКоординатор на площадке",
                'features_en' => "Concept development\nVenue selection\nBasic decor\nOn-site coordinator",
                'features_az' => "Konsepsiya hazırlanması\nMəkan seçimi\nBazis dekor\nMəkanda koordinator",
            ],
            [
                'name_ru' => 'Бизнес',
                'name_en' => 'Business',
                'name_az' => 'Biznes',
                'guests_ru' => 'До 150 гостей',
                'guests_en' => 'Up to 150 guests',
                'guests_az' => '150 qonaqa qədər',
                'price' => '5000',
                'is_featured' => true,
                'features_ru' => "Всё из пакета «Стартовый»\nТехническое обеспечение\nРазвлекательная программа\nФото и видеосъёмка\nБрендирование",
                'features_en' => "Everything from Starter\nTechnical support\nEntertainment program\nPhoto and video\nBranding",
                'features_az' => "Başlanğıc paketindən hər şey\nTexniki təminat\nƏyləncə proqramı\nFoto və video\nBrendinq",
            ],
            [
                'name_ru' => 'Премиум',
                'name_en' => 'Premium',
                'name_az' => 'Premium',
                'guests_ru' => 'Без ограничений',
                'guests_en' => 'Unlimited',
                'guests_az' => 'Limitsiz',
                'price' => '10000+',
                'is_featured' => false,
                'features_ru' => "Всё из пакета «Бизнес»\nVIP-обслуживание\nПриглашённые артисты\nИндивидуальный дизайн\n24/7 поддержка",
                'features_en' => "Everything from Business\nVIP service\nInvited artists\nIndividual design\n24/7 support",
                'features_az' => "Biznes paketindən hər şey\nVIP xidmət\nDəvət olunmuş artistlər\nFərdi dizayn\n24/7 dəstək",
            ],
        ];

        // Wedding pricing
        $weddingPricing = [
            [
                'name_ru' => 'Классика',
                'name_en' => 'Classic',
                'name_az' => 'Klassik',
                'guests_ru' => 'До 100 гостей',
                'guests_en' => 'Up to 100 guests',
                'guests_az' => '100 qonaqa qədər',
                'price' => '3000',
                'is_featured' => false,
                'features_ru' => "Полная организация\nПодбор площадки\nКоординация дня\nБазовый декор\nФотограф",
                'features_en' => "Full organization\nVenue selection\nDay coordination\nBasic decor\nPhotographer",
                'features_az' => "Tam təşkilat\nMəkan seçimi\nGün koordinasiyası\nBazis dekor\nFotoqraf",
            ],
            [
                'name_ru' => 'Люкс',
                'name_en' => 'Luxury',
                'name_az' => 'Lüks',
                'guests_ru' => 'До 300 гостей',
                'guests_en' => 'Up to 300 guests',
                'guests_az' => '300 qonaqa qədər',
                'price' => '8000',
                'is_featured' => true,
                'features_ru' => "Всё из пакета «Классика»\nПремиум декор и флористика\nФото и видеосъёмка\nLED экран и звук\nВедущий и DJ",
                'features_en' => "Everything from Classic\nPremium decor and floristry\nPhoto and video\nLED screen and sound\nHost and DJ",
                'features_az' => "Klassik paketdən hər şey\nPremium dekor və floristika\nFoto və video\nLED ekran və səs\nAparıcı və DJ",
            ],
            [
                'name_ru' => 'Эксклюзив',
                'name_en' => 'Exclusive',
                'name_az' => 'Eksklüziv',
                'guests_ru' => 'Без ограничений',
                'guests_en' => 'Unlimited',
                'guests_az' => 'Limitsiz',
                'price' => '15000+',
                'is_featured' => false,
                'features_ru' => "Всё из пакета «Люкс»\nИндивидуальный дизайн\nПриглашённые артисты\nLive музыка\n24/7 менеджер",
                'features_en' => "Everything from Luxury\nIndividual design\nInvited artists\nLive music\n24/7 manager",
                'features_az' => "Lüks paketdən hər şey\nFərdi dizayn\nDəvət olunmuş artistlər\nCanlı musiqi\n24/7 menecer",
            ],
        ];

        // Conference pricing
        $conferencePricing = [
            [
                'name_ru' => 'Базовый',
                'name_en' => 'Basic',
                'name_az' => 'Bazis',
                'guests_ru' => 'До 100 участников',
                'guests_en' => 'Up to 100 participants',
                'guests_az' => '100 iştirakçıya qədər',
                'price' => '2500',
                'is_featured' => false,
                'features_ru' => "Подбор площадки\nТехническое оснащение\nРегистрация участников\nКофе-брейки",
                'features_en' => "Venue selection\nTechnical equipment\nParticipant registration\nCoffee breaks",
                'features_az' => "Məkan seçimi\nTexniki avadanlıq\nİştirakçı qeydiyyatı\nQəhvə fasilələri",
            ],
            [
                'name_ru' => 'Профессионал',
                'name_en' => 'Professional',
                'name_az' => 'Peşəkar',
                'guests_ru' => 'До 300 участников',
                'guests_en' => 'Up to 300 participants',
                'guests_az' => '300 iştirakçıya qədər',
                'price' => '6000',
                'is_featured' => true,
                'features_ru' => "Всё из пакета «Базовый»\nСинхронный перевод\nОнлайн трансляция\nПечатная продукция\nФото и видео",
                'features_en' => "Everything from Basic\nSimultaneous translation\nOnline streaming\nPrinted materials\nPhoto and video",
                'features_az' => "Bazis paketdən hər şey\nSinxron tərcümə\nOnlayn yayım\nÇap məhsulları\nFoto və video",
            ],
            [
                'name_ru' => 'Форум',
                'name_en' => 'Forum',
                'name_az' => 'Forum',
                'guests_ru' => 'Без ограничений',
                'guests_en' => 'Unlimited',
                'guests_az' => 'Limitsiz',
                'price' => '12000+',
                'is_featured' => false,
                'features_ru' => "Всё из пакета «Профессионал»\nМультиязычный сайт события\nМобильное приложение\nVIP зона\nГала-ужин",
                'features_en' => "Everything from Professional\nMultilingual event website\nMobile app\nVIP zone\nGala dinner",
                'features_az' => "Peşəkar paketdən hər şey\nÇoxdilli tədbir saytı\nMobil tətbiq\nVIP zona\nQala şam yeməyi",
            ],
        ];

        // Corporate FAQ
        $corporateFaq = [
            [
                'question_ru' => 'За сколько нужно бронировать корпоратив?',
                'question_en' => 'How far in advance should I book a corporate event?',
                'question_az' => 'Korporativ tədbiri nə qədər əvvəl sifariş etmək lazımdır?',
                'answer_ru' => 'Рекомендуем бронировать за 2-3 месяца для крупных мероприятий (100+ гостей) и за 1 месяц для небольших. В пиковый сезон (декабрь, новогодние корпоративы) желательно обращаться за 4-6 месяцев.',
                'answer_en' => 'We recommend booking 2-3 months in advance for large events (100+ guests) and 1 month for smaller ones. During peak season (December, New Year corporate events), we advise contacting us 4-6 months ahead.',
                'answer_az' => 'Böyük tədbirlər üçün (100+ qonaq) 2-3 ay, kiçiklər üçün 1 ay əvvəl sifariş etməyi tövsiyə edirik. Pik mövsümdə (dekabr, Yeni il korporativləri) 4-6 ay əvvəl müraciət etmək məsləhətdir.',
            ],
            [
                'question_ru' => 'Можете организовать корпоратив за пределами Баку?',
                'question_en' => 'Can you organize a corporate event outside Baku?',
                'question_az' => 'Bakıdan kənarda korporativ tədbir təşkil edə bilərsiniz?',
                'answer_ru' => 'Да, мы организуем корпоративные мероприятия по всему Азербайджану: Габала, Шеки, Гусар, Ленкорань. Также имеем опыт проведения за рубежом — в Грузии и Турции.',
                'answer_en' => 'Yes, we organize corporate events throughout Azerbaijan: Gabala, Sheki, Gusar, Lankaran. We also have experience abroad — in Georgia and Turkey.',
                'answer_az' => 'Bəli, bütün Azərbaycan üzrə korporativ tədbirlər təşkil edirik: Qəbələ, Şəki, Qusar, Lənkəran. Xaricdə də təcrübəmiz var — Gürcüstan və Türkiyədə.',
            ],
            [
                'question_ru' => 'Что не входит в стоимость пакета?',
                'question_en' => 'What is not included in the package price?',
                'question_az' => 'Paket qiymətinə nə daxil deyil?',
                'answer_ru' => 'Стоимость пакета включает работу нашей команды. Дополнительно оплачиваются: аренда площадки, кейтеринг, артисты, транспорт гостей. Мы составляем детальную смету заранее, без скрытых платежей.',
                'answer_en' => 'The package price includes our team\'s work. Additionally paid: venue rental, catering, artists, guest transportation. We prepare a detailed estimate in advance, with no hidden fees.',
                'answer_az' => 'Paket qiymətinə komandamızın işi daxildir. Əlavə ödənilir: məkan icarəsi, keyterinq, artistlər, qonaqların nəqliyyatı. Əvvəlcədən gizli ödənişlər olmadan ətraflı smeta hazırlayırıq.',
            ],
            [
                'question_ru' => 'Работаете ли вы с тендерами?',
                'question_en' => 'Do you work with tenders?',
                'question_az' => 'Tenderlərlə işləyirsiniz?',
                'answer_ru' => 'Да, мы работаем с государственными и частными компаниями через тендерные процедуры. Имеем опыт работы с крупными корпорациями и можем предоставить все необходимые документы.',
                'answer_en' => 'Yes, we work with government and private companies through tender procedures. We have experience with large corporations and can provide all necessary documents.',
                'answer_az' => 'Bəli, dövlət və özəl şirkətlərlə tender prosedurları vasitəsilə işləyirik. Böyük korporasiyalarla təcrübəmiz var və bütün lazımi sənədləri təqdim edə bilərik.',
            ],
        ];

        // Wedding FAQ
        $weddingFaq = [
            [
                'question_ru' => 'За сколько нужно бронировать свадьбу?',
                'question_en' => 'How far in advance should I book a wedding?',
                'question_az' => 'Toyu nə qədər əvvəl sifariş etmək lazımdır?',
                'answer_ru' => 'Рекомендуем бронировать за 6-12 месяцев до даты свадьбы. В популярные даты (летние месяцы, красивые числа) бронирование желательно за год.',
                'answer_en' => 'We recommend booking 6-12 months before the wedding date. For popular dates (summer months, beautiful numbers), booking a year in advance is advisable.',
                'answer_az' => 'Toy tarixindən 6-12 ay əvvəl sifariş etməyi tövsiyə edirik. Populyar tarixlər üçün (yay ayları, gözəl tarixlər) bir il əvvəl sifariş etmək məsləhətdir.',
            ],
            [
                'question_ru' => 'Можете организовать выездную церемонию?',
                'question_en' => 'Can you organize an outdoor ceremony?',
                'question_az' => 'Açıq havada mərasim təşkil edə bilərsiniz?',
                'answer_ru' => 'Да, мы специализируемся на выездных церемониях. Организуем свадьбы на природе, в горах, у моря или в красивых загородных локациях.',
                'answer_en' => 'Yes, we specialize in outdoor ceremonies. We organize weddings in nature, mountains, by the sea, or in beautiful countryside locations.',
                'answer_az' => 'Bəli, açıq havada mərasimlərdə ixtisaslaşmışıq. Təbiətdə, dağlarda, dəniz kənarında və ya gözəl kənd yerlərində toylar təşkil edirik.',
            ],
            [
                'question_ru' => 'Работаете ли вы с небольшими свадьбами?',
                'question_en' => 'Do you work with small weddings?',
                'question_az' => 'Kiçik toylarla işləyirsiniz?',
                'answer_ru' => 'Да, мы организуем камерные свадьбы от 20 гостей. Для небольших торжеств предлагаем специальные пакеты с индивидуальным подходом.',
                'answer_en' => 'Yes, we organize intimate weddings from 20 guests. For small celebrations, we offer special packages with an individual approach.',
                'answer_az' => 'Bəli, 20 qonaqdan başlayaraq kiçik toylar təşkil edirik. Kiçik tədbirlər üçün fərdi yanaşma ilə xüsusi paketlər təklif edirik.',
            ],
            [
                'question_ru' => 'Включен ли декор в стоимость?',
                'question_en' => 'Is decor included in the price?',
                'question_az' => 'Dekor qiymətə daxildir?',
                'answer_ru' => 'Базовый декор включён в стоимость пакетов «Люкс» и «Эксклюзив». Для пакета «Классика» декор оплачивается отдельно по смете.',
                'answer_en' => 'Basic decor is included in Luxury and Exclusive packages. For the Classic package, decor is paid separately according to the estimate.',
                'answer_az' => 'Bazis dekor Lüks və Eksklüziv paketlərə daxildir. Klassik paket üçün dekor smetaya uyğun ayrıca ödənilir.',
            ],
        ];

        // Conference FAQ
        $conferenceFaq = [
            [
                'question_ru' => 'Можете организовать гибридную конференцию?',
                'question_en' => 'Can you organize a hybrid conference?',
                'question_az' => 'Hibrid konfrans təşkil edə bilərsiniz?',
                'answer_ru' => 'Да, мы организуем гибридные мероприятия с онлайн-трансляцией для удалённых участников. Обеспечиваем качественный стриминг и интерактивные инструменты.',
                'answer_en' => 'Yes, we organize hybrid events with online streaming for remote participants. We provide quality streaming and interactive tools.',
                'answer_az' => 'Bəli, uzaq iştirakçılar üçün onlayn yayımla hibrid tədbirlər təşkil edirik. Keyfiyyətli yayım və interaktiv alətlər təmin edirik.',
            ],
            [
                'question_ru' => 'Есть ли у вас опыт международных конференций?',
                'question_en' => 'Do you have experience with international conferences?',
                'question_az' => 'Beynəlxalq konfranslarda təcrübəniz varmı?',
                'answer_ru' => 'Да, мы организовывали конференции с участниками из 20+ стран. Обеспечиваем синхронный перевод, визовую поддержку и трансфер.',
                'answer_en' => 'Yes, we have organized conferences with participants from 20+ countries. We provide simultaneous translation, visa support, and transfers.',
                'answer_az' => '20+ ölkədən iştirakçılarla konfranslar təşkil etmişik. Sinxron tərcümə, viza dəstəyi və transfer təmin edirik.',
            ],
            [
                'question_ru' => 'Какое техническое оборудование вы предоставляете?',
                'question_en' => 'What technical equipment do you provide?',
                'question_az' => 'Hansı texniki avadanlıq təqdim edirsiniz?',
                'answer_ru' => 'Мы предоставляем полный комплекс: звуковое оборудование, LED экраны, проекторы, системы синхронного перевода, интернет-покрытие.',
                'answer_en' => 'We provide a full range: sound equipment, LED screens, projectors, simultaneous translation systems, internet coverage.',
                'answer_az' => 'Tam kompleks təqdim edirik: səs avadanlığı, LED ekranlar, proyektorlar, sinxron tərcümə sistemləri, internet əhatəsi.',
            ],
        ];

        // Default FAQ for other services
        $defaultFaq = [
            [
                'question_ru' => 'Как происходит оплата?',
                'question_en' => 'How is payment made?',
                'question_az' => 'Ödəniş necə həyata keçirilir?',
                'answer_ru' => 'Оплата производится поэтапно: 30% предоплата при подписании договора, 50% за 2 недели до мероприятия, 20% после проведения.',
                'answer_en' => 'Payment is made in stages: 30% advance upon signing the contract, 50% 2 weeks before the event, 20% after the event.',
                'answer_az' => 'Ödəniş mərhələli şəkildə: müqavilə imzalanarkən 30% avans, tədbirdən 2 həftə əvvəl 50%, tədbirdən sonra 20%.',
            ],
            [
                'question_ru' => 'Можно ли организовать мероприятие срочно?',
                'question_en' => 'Can you organize an event urgently?',
                'question_az' => 'Təcili tədbir təşkil etmək olarmı?',
                'answer_ru' => 'Да, при наличии свободных ресурсов можем организовать мероприятие за 1-2 недели. Срочные заказы рассчитываются с дополнительным коэффициентом.',
                'answer_en' => 'Yes, if resources are available, we can organize an event in 1-2 weeks. Rush orders are calculated with an additional coefficient.',
                'answer_az' => 'Bəli, resurslar mövcud olduqda 1-2 həftə ərzində tədbir təşkil edə bilərik. Təcili sifarişlər əlavə əmsalla hesablanır.',
            ],
            [
                'question_ru' => 'Работаете ли вы за пределами Баку?',
                'question_en' => 'Do you work outside Baku?',
                'question_az' => 'Bakıdan kənarda işləyirsiniz?',
                'answer_ru' => 'Да, мы организуем мероприятия по всему Азербайджану, а также в Грузии и Турции.',
                'answer_en' => 'Yes, we organize events throughout Azerbaijan, as well as in Georgia and Turkey.',
                'answer_az' => 'Bəli, bütün Azərbaycan üzrə, həmçinin Gürcüstan və Türkiyədə tədbirlər təşkil edirik.',
            ],
        ];

        // Default pricing for other services
        $defaultPricing = [
            [
                'name_ru' => 'Базовый',
                'name_en' => 'Basic',
                'name_az' => 'Bazis',
                'guests_ru' => 'До 50 гостей',
                'guests_en' => 'Up to 50 guests',
                'guests_az' => '50 qonaqa qədər',
                'price' => '500',
                'is_featured' => false,
                'features_ru' => "Базовая организация\nКоординатор\nПодбор площадки",
                'features_en' => "Basic organization\nCoordinator\nVenue selection",
                'features_az' => "Bazis təşkilat\nKoordinator\nMəkan seçimi",
            ],
            [
                'name_ru' => 'Стандарт',
                'name_en' => 'Standard',
                'name_az' => 'Standart',
                'guests_ru' => 'До 150 гостей',
                'guests_en' => 'Up to 150 guests',
                'guests_az' => '150 qonaqa qədər',
                'price' => '1500',
                'is_featured' => true,
                'features_ru' => "Полная организация\nДекор и флористика\nФото и видео\nDJ и ведущий",
                'features_en' => "Full organization\nDecor and floristry\nPhoto and video\nDJ and host",
                'features_az' => "Tam təşkilat\nDekor və floristika\nFoto və video\nDJ və aparıcı",
            ],
            [
                'name_ru' => 'Премиум',
                'name_en' => 'Premium',
                'name_az' => 'Premium',
                'guests_ru' => 'Без ограничений',
                'guests_en' => 'Unlimited',
                'guests_az' => 'Limitsiz',
                'price' => '3000+',
                'is_featured' => false,
                'features_ru' => "VIP-обслуживание\nИндивидуальный дизайн\nПриглашённые артисты\n24/7 поддержка",
                'features_en' => "VIP service\nIndividual design\nInvited artists\n24/7 support",
                'features_az' => "VIP xidmət\nFərdi dizayn\nDəvət olunmuş artistlər\n24/7 dəstək",
            ],
        ];

        // Offers for different service types
        $corporateOffers = [
            ['icon' => 'layers', 'title_ru' => 'Тимбилдинг', 'title_en' => 'Team Building', 'title_az' => 'Komanda quruculuğu', 'description_ru' => 'Активности для сплочения команды: квесты, спортивные соревнования, творческие мастер-классы', 'description_en' => 'Team bonding activities: quests, sports competitions, creative workshops', 'description_az' => 'Komandanı birləşdirən fəaliyyətlər: kvestlər, idman yarışları, yaradıcı ustalar'],
            ['icon' => 'calendar', 'title_ru' => 'Конференции', 'title_en' => 'Conferences', 'title_az' => 'Konfranslar', 'description_ru' => 'Профессиональная организация деловых мероприятий с техническим сопровождением', 'description_en' => 'Professional business event organization with technical support', 'description_az' => 'Texniki dəstəklə peşəkar biznes tədbirlərinin təşkili'],
            ['icon' => 'star', 'title_ru' => 'Юбилеи компаний', 'title_en' => 'Company Anniversaries', 'title_az' => 'Şirkət yubileyləri', 'description_ru' => 'Праздничные мероприятия в честь важных дат с уникальной программой', 'description_en' => 'Celebratory events for important dates with unique programs', 'description_az' => 'Mühüm tarixlər üçün unikal proqramlarla bayram tədbirləri'],
            ['icon' => 'play', 'title_ru' => 'Презентации', 'title_en' => 'Presentations', 'title_az' => 'Təqdimatlar', 'description_ru' => 'Запуск продуктов, пресс-конференции, встречи с партнёрами', 'description_en' => 'Product launches, press conferences, partner meetings', 'description_az' => 'Məhsul təqdimatları, mətbuat konfransları, tərəfdaş görüşləri'],
        ];

        $weddingOffers = [
            ['icon' => 'heart', 'title_ru' => 'Классические свадьбы', 'title_en' => 'Classic Weddings', 'title_az' => 'Klassik toylar', 'description_ru' => 'Традиционные торжества с соблюдением всех обычаев и современным подходом', 'description_en' => 'Traditional celebrations with all customs and modern approach', 'description_az' => 'Bütün adətlərə riayət və müasir yanaşma ilə ənənəvi tədbirlər'],
            ['icon' => 'map', 'title_ru' => 'Выездные церемонии', 'title_en' => 'Outdoor Ceremonies', 'title_az' => 'Açıq hava mərasimləri', 'description_ru' => 'Свадьбы на природе, в горах или у моря с уникальной атмосферой', 'description_en' => 'Weddings in nature, mountains or by the sea with unique atmosphere', 'description_az' => 'Unikal atmosferlə təbiətdə, dağlarda və ya dəniz kənarında toylar'],
            ['icon' => 'camera', 'title_ru' => 'Фото и видео', 'title_en' => 'Photo & Video', 'title_az' => 'Foto və video', 'description_ru' => 'Профессиональная съёмка вашего особенного дня', 'description_en' => 'Professional coverage of your special day', 'description_az' => 'Xüsusi gününüzün peşəkar çəkilişi'],
            ['icon' => 'music', 'title_ru' => 'Музыкальное оформление', 'title_en' => 'Musical Design', 'title_az' => 'Musiqi dizaynı', 'description_ru' => 'DJ, живая музыка, приглашённые артисты', 'description_en' => 'DJ, live music, invited artists', 'description_az' => 'DJ, canlı musiqi, dəvət olunmuş artistlər'],
        ];

        // Update all services
        $services = Service::all();

        foreach ($services as $service) {
            $slug = $service->slug;
            $data = [
                'process' => $commonProcess,
            ];

            // Assign specific data based on service type
            if (str_contains($slug, 'korporativ') || str_contains($slug, 'corporate')) {
                $data['pricing'] = $corporatePricing;
                $data['faq'] = $corporateFaq;
                $data['offers'] = $corporateOffers;
            } elseif (str_contains($slug, 'svadba') || str_contains($slug, 'wedding') || str_contains($slug, 'toy')) {
                $data['pricing'] = $weddingPricing;
                $data['faq'] = $weddingFaq;
                $data['offers'] = $weddingOffers;
            } elseif (str_contains($slug, 'konferenc') || str_contains($slug, 'conference') || str_contains($slug, 'konfrans')) {
                $data['pricing'] = $conferencePricing;
                $data['faq'] = $conferenceFaq;
            } else {
                $data['pricing'] = $defaultPricing;
                $data['faq'] = $defaultFaq;
            }

            // Only update if offers is empty
            if (empty($service->offers)) {
                $data['offers'] = $data['offers'] ?? $corporateOffers;
            }

            $service->update($data);
        }

        $this->command->info('Service test data has been added successfully!');
    }
}
