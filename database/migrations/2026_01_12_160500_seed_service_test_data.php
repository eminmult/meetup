<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
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

        // Default pricing
        $defaultPricing = [
            [
                'name_ru' => 'Базовый',
                'name_en' => 'Basic',
                'name_az' => 'Bazis',
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
                'name_ru' => 'Стандарт',
                'name_en' => 'Standard',
                'name_az' => 'Standart',
                'guests_ru' => 'До 150 гостей',
                'guests_en' => 'Up to 150 guests',
                'guests_az' => '150 qonaqa qədər',
                'price' => '5000',
                'is_featured' => true,
                'features_ru' => "Всё из пакета «Базовый»\nТехническое обеспечение\nРазвлекательная программа\nФото и видеосъёмка\nБрендирование",
                'features_en' => "Everything from Basic\nTechnical support\nEntertainment program\nPhoto and video\nBranding",
                'features_az' => "Bazis paketindən hər şey\nTexniki təminat\nƏyləncə proqramı\nFoto və video\nBrendinq",
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
                'features_ru' => "Всё из пакета «Стандарт»\nVIP-обслуживание\nПриглашённые артисты\nИндивидуальный дизайн\n24/7 поддержка",
                'features_en' => "Everything from Standard\nVIP service\nInvited artists\nIndividual design\n24/7 support",
                'features_az' => "Standart paketindən hər şey\nVIP xidmət\nDəvət olunmuş artistlər\nFərdi dizayn\n24/7 dəstək",
            ],
        ];

        // Default FAQ
        $defaultFaq = [
            [
                'question_ru' => 'За сколько нужно бронировать мероприятие?',
                'question_en' => 'How far in advance should I book an event?',
                'question_az' => 'Tədbiri nə qədər əvvəl sifariş etmək lazımdır?',
                'answer_ru' => 'Рекомендуем бронировать за 2-3 месяца для крупных мероприятий (100+ гостей) и за 1 месяц для небольших. В пиковый сезон желательно обращаться за 4-6 месяцев.',
                'answer_en' => 'We recommend booking 2-3 months in advance for large events (100+ guests) and 1 month for smaller ones. During peak season, we advise contacting us 4-6 months ahead.',
                'answer_az' => 'Böyük tədbirlər üçün (100+ qonaq) 2-3 ay, kiçiklər üçün 1 ay əvvəl sifariş etməyi tövsiyə edirik. Pik mövsümdə 4-6 ay əvvəl müraciət etmək məsləhətdir.',
            ],
            [
                'question_ru' => 'Работаете ли вы за пределами Баку?',
                'question_en' => 'Do you work outside Baku?',
                'question_az' => 'Bakıdan kənarda işləyirsiniz?',
                'answer_ru' => 'Да, мы организуем мероприятия по всему Азербайджану: Габала, Шеки, Гусар, Ленкорань. Также имеем опыт проведения за рубежом — в Грузии и Турции.',
                'answer_en' => 'Yes, we organize events throughout Azerbaijan: Gabala, Sheki, Gusar, Lankaran. We also have experience abroad — in Georgia and Turkey.',
                'answer_az' => 'Bəli, bütün Azərbaycan üzrə tədbirlər təşkil edirik: Qəbələ, Şəki, Qusar, Lənkəran. Xaricdə də təcrübəmiz var — Gürcüstan və Türkiyədə.',
            ],
            [
                'question_ru' => 'Что входит в стоимость услуг?',
                'question_en' => 'What is included in the service cost?',
                'question_az' => 'Xidmət qiymətinə nə daxildir?',
                'answer_ru' => 'Базовая стоимость включает работу event-менеджера, разработку концепции и координацию. Дополнительные услуги (декор, кейтеринг, артисты) оплачиваются отдельно согласно смете.',
                'answer_en' => 'The base price includes event manager work, concept development and coordination. Additional services (decor, catering, artists) are paid separately according to the estimate.',
                'answer_az' => 'Bazis qiymətə event-menecerin işi, konsepsiya hazırlanması və koordinasiya daxildir. Əlavə xidmətlər (dekor, keyterinq, artistlər) smetaya uyğun ayrıca ödənilir.',
            ],
            [
                'question_ru' => 'Можно ли организовать мероприятие срочно?',
                'question_en' => 'Can you organize an event urgently?',
                'question_az' => 'Təcili tədbir təşkil etmək olarmı?',
                'answer_ru' => 'Да, мы берёмся за срочные проекты. При наличии свободных ресурсов можем организовать мероприятие за 1-2 недели. Срочные заказы рассчитываются с дополнительным коэффициентом.',
                'answer_en' => 'Yes, we take on urgent projects. If resources are available, we can organize an event in 1-2 weeks. Rush orders are calculated with an additional coefficient.',
                'answer_az' => 'Bəli, təcili layihələr qəbul edirik. Resurslar mövcud olduqda 1-2 həftə ərzində tədbir təşkil edə bilərik. Təcili sifarişlər əlavə əmsalla hesablanır.',
            ],
            [
                'question_ru' => 'Как происходит оплата?',
                'question_en' => 'How is payment made?',
                'question_az' => 'Ödəniş necə həyata keçirilir?',
                'answer_ru' => 'Оплата производится поэтапно: 30% предоплата при подписании договора, 50% за 2 недели до мероприятия, 20% после проведения. Принимаем наличные и безналичный расчёт.',
                'answer_en' => 'Payment is made in stages: 30% advance upon signing the contract, 50% 2 weeks before the event, 20% after the event. We accept cash and bank transfers.',
                'answer_az' => 'Ödəniş mərhələli şəkildə: müqavilə imzalanarkən 30% avans, tədbirdən 2 həftə əvvəl 50%, tədbirdən sonra 20%. Nağd və köçürmə qəbul edirik.',
            ],
        ];

        // Default offers
        $defaultOffers = [
            ['icon' => 'layers', 'title_ru' => 'Полная организация', 'title_en' => 'Full Organization', 'title_az' => 'Tam təşkilat', 'description_ru' => 'Берём на себя все этапы от концепции до реализации', 'description_en' => 'We handle all stages from concept to execution', 'description_az' => 'Konsepsiyadan reallaşdırmaya qədər bütün mərhələləri öhdəmizə götürürük'],
            ['icon' => 'calendar', 'title_ru' => 'Координация', 'title_en' => 'Coordination', 'title_az' => 'Koordinasiya', 'description_ru' => 'Профессиональный координатор на площадке в день мероприятия', 'description_en' => 'Professional coordinator on site on the event day', 'description_az' => 'Tədbir günü məkanda peşəkar koordinator'],
            ['icon' => 'star', 'title_ru' => 'Декор и оформление', 'title_en' => 'Decor & Design', 'title_az' => 'Dekor və dizayn', 'description_ru' => 'Уникальное оформление под стиль вашего мероприятия', 'description_en' => 'Unique decoration matching your event style', 'description_az' => 'Tədbirinizin üslubuna uyğun unikal dekorasiya'],
            ['icon' => 'camera', 'title_ru' => 'Фото и видео', 'title_en' => 'Photo & Video', 'title_az' => 'Foto və video', 'description_ru' => 'Профессиональная съёмка для сохранения воспоминаний', 'description_en' => 'Professional coverage to preserve memories', 'description_az' => 'Xatirələri qorumaq üçün peşəkar çəkiliş'],
        ];

        // Update all services
        $services = Service::all();

        foreach ($services as $service) {
            $updateData = [];

            // Only update if field is empty
            if (empty($service->process)) {
                $updateData['process'] = $commonProcess;
            }
            if (empty($service->pricing)) {
                $updateData['pricing'] = $defaultPricing;
            }
            if (empty($service->faq)) {
                $updateData['faq'] = $defaultFaq;
            }
            if (empty($service->offers)) {
                $updateData['offers'] = $defaultOffers;
            }

            if (!empty($updateData)) {
                $service->update($updateData);
            }
        }
    }

    public function down(): void
    {
        // Clear test data
        Service::query()->update([
            'process' => null,
            'pricing' => null,
            'faq' => null,
        ]);
    }
};
