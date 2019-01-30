<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ('../lock.php');
//print_r($_POST);
include_once ($_SERVER['DOCUMENT_ROOT'] . "/lib/core.php");
function mk_link_arr(){
    $m = db();
    $q = "SELECT id,ang_subcat,parent FROM ang_subcategories";
    $t = $m -> prepare($q);
    $t -> execute();
    while($data = $t -> fetch(PDO::FETCH_ASSOC)){
   
    $link = '/subcat-1-'. $data["id"] . '-' . $data["parent"] .'-' . rus2translit($data["ang_subcat"]) . '-Porter/';
        echo '\'http://angara77.com' . $link . '\', ';
    }
}
mk_link_arr();

function get_urls($words){
    $m = db();
    $key = 'генератор';
    //foreach($words as $key){
    $q = "SELECT ang_name,cat,1c_id FROM angara WHERE ang_name LIKE ?";
    $t = $m -> prepare($q);
    $t -> execute(array($key.'%'));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
   
   // }
    //p($data);
    return $data;
}
$r = array ('http://angara77.com/subcat-1-1-2-Amortizatory-Porter/', 'http://angara77.com/subcat-1-2-2-Vtulki-Porter/', 'http://angara77.com/subcat-1-3-2-Diski-kolesnye-Porter/', 'http://angara77.com/subcat-1-4-2-Most-zadniy-Porter/', 'http://angara77.com/subcat-1-5-2-Kardan-Porter/', 'http://angara77.com/subcat-1-6-11-Korobka-vsbore-Porter/', 'http://angara77.com/subcat-1-7-2-Podshipniki-Porter/', 'http://angara77.com/subcat-1-8-2-Poluos-Porter/', 'http://angara77.com/subcat-1-9-2-Ressory-Porter/', 'http://angara77.com/subcat-1-10-2-Rulevoe-upr-Porter/', 'http://angara77.com/subcat-1-11-2-Rychagi-Porter/', 'http://angara77.com/subcat-1-12-2-Stupicy-Porter/', 'http://angara77.com/subcat-1-13-2-Sceplenie-Porter/', 'http://angara77.com/subcat-1-15-2-Torsiony-Porter/', 'http://angara77.com/subcat-1-16-7-Shiny-Porter/', 'http://angara77.com/subcat-1-17-7-Kolodki-Porter/', 'http://angara77.com/subcat-1-18-7-Remni-Porter/', 'http://angara77.com/subcat-1-19-7-Filtry-Porter/', 'http://angara77.com/subcat-1-20-3-Balansiry-Porter/', 'http://angara77.com/subcat-1-21-3-Blok-dvigatelya-Porter/', 'http://angara77.com/subcat-1-22-3-Golovka-Porter/', 'http://angara77.com/subcat-1-23-3-GRM-Porter/', 'http://angara77.com/subcat-1-24-3-Klapany-Porter/', 'http://angara77.com/subcat-1-25-3-Raznoe-dvigatel-Porter/', 'http://angara77.com/subcat-1-26-3-Kolenval-Porter/', 'http://angara77.com/subcat-1-27-3-Mahovik-Porter/', 'http://angara77.com/subcat-1-28-3-Nasos-maslyanyy-Porter/', 'http://angara77.com/subcat-1-29-3-Poddon-Porter/', 'http://angara77.com/subcat-1-30-3-Porshnevaya-Porter/', 'http://angara77.com/subcat-1-31-3-Turbina-Porter/', 'http://angara77.com/subcat-1-32-3-Forsunki-Porter/', 'http://angara77.com/subcat-1-33-3-Shkiv-Porter/', 'http://angara77.com/subcat-1-34-3-Toplivnaya-sist-Porter/', 'http://angara77.com/subcat-1-35-1-Bamper-Porter/', 'http://angara77.com/subcat-1-36-1-Dveri-Porter/', 'http://angara77.com/subcat-1-37-1-Deflektory-Porter/', 'http://angara77.com/subcat-1-38-1-Zamki-Porter/', 'http://angara77.com/subcat-1-39-1-Zerkala-Porter/', 'http://angara77.com/subcat-1-40-1-Kapot-Porter/', 'http://angara77.com/subcat-1-41-1-Krylo-Porter/', 'http://angara77.com/subcat-1-42-1-Stekla-Porter/', 'http://angara77.com/subcat-1-44-1-Fary-Porter/', 'http://angara77.com/subcat-1-45-1-Raznoe-kuzov-Porter/', 'http://angara77.com/subcat-1-46-4-Glushiteli-Porter/', 'http://angara77.com/subcat-1-47-4-Kollektory-Porter/', 'http://angara77.com/subcat-1-48-8-Prokladki-Porter/', 'http://angara77.com/subcat-1-50-8-Bachki-Porter/', 'http://angara77.com/subcat-1-51-8-Pedali-Porter/', 'http://angara77.com/subcat-1-52-10-Radiatory-Porter/', 'http://angara77.com/subcat-1-53-10-Pechka-Porter/', 'http://angara77.com/subcat-1-54-10-Pompa-Porter/', 'http://angara77.com/subcat-1-55-10-Ventilyator-Porter/', 'http://angara77.com/subcat-1-56-10-Termostat-Porter/', 'http://angara77.com/subcat-1-57-6-Generator-Porter/', 'http://angara77.com/subcat-1-58-6-Starter-Porter/', 'http://angara77.com/subcat-1-59-6-Provodka-Porter/', 'http://angara77.com/subcat-1-60-6-Datchiki-Porter/', 'http://angara77.com/subcat-1-62-6-Rele-Porter/', 'http://angara77.com/subcat-1-63-6-Lampy-Porter/', 'http://angara77.com/subcat-1-64-6-Svechi-Porter/', 'http://angara77.com/subcat-1-65-6-Signal-Porter/', 'http://angara77.com/subcat-1-66-6-Panel-priborov-Porter/', 'http://angara77.com/subcat-1-67-6-Predohraniteli-Porter/', 'http://angara77.com/subcat-1-68-6-Elektrika-raznoe-Porter/', 'http://angara77.com/subcat-1-69-11-Valy-shesterni-Porter/', 'http://angara77.com/subcat-1-70-11-Podshipniki-Porter/', 'http://angara77.com/subcat-1-71-11-Rychag-kulisa-Porter/', 'http://angara77.com/subcat-1-72-11-Sinhronizatory-Porter/', 'http://angara77.com/subcat-1-73-11-Salniki-Porter/', 'http://angara77.com/subcat-1-74-11-Raznoe-KPP-Porter/', 'http://angara77.com/subcat-1-75-11-Vilki-Porter/', 'http://angara77.com/subcat-1-76-12-Cilindry-Porter/', 'http://angara77.com/subcat-1-77-12-Diski-barabany-Porter/', 'http://angara77.com/subcat-1-78-12-Trubki-shlangi-Porter/', 'http://angara77.com/subcat-1-79-12-Ruchnik-Porter/', 'http://angara77.com/subcat-1-80-12-Raznoe-tormoza-Porter/', 'http://angara77.com/subcat-1-81-12-Supporty-Porter/', 'http://angara77.com/subcat-1-82-1-Fonari-Porter/', 'http://angara77.com/subcat-1-83-1-Kabina-Porter/', 'http://angara77.com/subcat-1-84-6-Steklopodemnik-Porter/', 'http://angara77.com/subcat-1-85-6-Stekloochistitel-Porter/', 'http://angara77.com/subcat-1-86-10-Patrubki-Porter/', 'http://angara77.com/subcat-1-87-6-Spidometr-Porter/', 'http://angara77.com/subcat-1-88-3-Koromysla-Porter/', 'http://angara77.com/subcat-1-89-1-Ruchki-Porter/', 'http://angara77.com/subcat-1-90-3-Vkladyshi-Porter/', 'http://angara77.com/subcat-1-91-10-Kondicioner-Porter/', 'http://angara77.com/subcat-1-92-3-Cep-Porter/', 'http://angara77.com/subcat-1-93-4-Podacha-vozduha-Porter/', 'http://angara77.com/subcat-1-94-2-Stabilizator-Porter/', 'http://angara77.com/subcat-1-95-8-Instrument-Porter/', 'http://angara77.com/subcat-1-96-8-Bolty-gayki-Porter/');


$words = array('Амортизат', 'Втулк', 'Диски колесные', 'Мост задний', 'Кардан', 'Коробк', 'Подшипники', 'Полуос', 'Рессор', 'Рулев', 'Рычаг', 'Ступиц', 'Сцеплен', 'Торсион', 'Шин', 'Колодк', 'Ремн', 'Фильтр', 'Балансир', 'двигател', 'Головк', 'ГРМ', 'Клапан', 'двигател', 'Коленва', 'Маховик', 'Насос масляный', 'Поддон', 'Поршневая', 'Турбин', 'Форсунк', 'Шкив', 'Топливн', 'Бампер', 'Двер', 'Дефлект', 'Зам', 'Зерк', 'Капот', 'Крыл', 'Стекл', 'Фар', 'кузов', 'Глушит', 'Коллект', 'Проклад', 'Бач', 'Педал', 'Радиатор', 'Печк', 'Помп', 'Вентилят', 'Термостат', 'Генератор', 'Стартер', 'Проводк', 'Датчик', 'Реле', 'Ламп', 'Свеч', 'Сигнал', 'Панель приборов', 'Предохранител', 'Электрика разное', 'Вал', 'Шестерн', 'кулиса', 'Синхронизат', 'Сальник', 'КПП', 'Вилк', 'Цилинд', 'бараба', 'Трубк', 'Ручник', 'тормоз', 'Суппорт', 'Фонар', 'Кабин', 'Стеклопод', 'Стеклооч', 'Патрубк', 'Спидометр', 'Коромысл', 'Ручк', 'Вкладыш', 'Кондиционер', 'Цепь', 'возду', 'Стабилизат', 'Инструмент', 'Болты гайки', 
);










