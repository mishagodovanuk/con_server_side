import { customDataTns } from "../db/data-tns-in-work.js";
import { markupActionInConfirmed } from "../render/logist/markup-action-in-confirmed.js";
import { initializeMap } from "./route-map.js";

var dataTns = customDataTns;

const selectedLanguage = localStorage.getItem("Language");
//відкрити таблицю
$("#open-table-page").click(function (e) {
    $("#table-page").removeClass("d-none");
    $("#view-consolid-page").addClass("d-none");
});

// відкрити перегляд консолід page
$(document).on("click", ".open-view-consolid", function (e) {
    $("#table-page").addClass("d-none");
    $("#view-consolid-page").removeClass("d-none");

    $("#list-for-action-confirmed").empty();
    $("#list-for-action-confirmed").html(
        markupActionInConfirmed(dataActions, dataTns)
    );
});


// ====
// додатково ініцілізувати мапу
$(".initialize-map").click(function (e) {
    initializeMap();
});

//рендер html де показує формули і їх логіку. різними мовами
const textInfoTotalEconomy =
    selectedLanguage === "ua"
        ? '<p>Для того, щоб дізнатися загальну економію<span class="fst-italic"> (Е<sub style="font-size: smaller;">заг</sub>) </span>, потрібно від суми вартості всіх пропозицій 3PL операторів <span class="fst-italic"> (В<sub style="font-size: smaller;">сум. 3PL</sub>) </span>, відняти вартість рейсу при консолідації <span class="fst-italic"> (В<sub style="font-size: smaller;">рейс кон</sub>) </span></p><p class="fst-italic">Е<sub style="font-size: smaller;">заг</sub> = В<sub style="font-size: smaller;">сум. 3PL</sub> - В<sub style="font-size: smaller;">рейс кон</sub></p>'
        : '<p>In order to find out the total savings<span class="fst-italic"> (E<sub style="font-size: smaller;">total</sub>) </span>, you need to subtract the cost of the consolidated route<span class="fst-italic"> (B<sub style="font-size: smaller;">consolidated route</sub>) </span>, from the sum of the cost of all 3PL offers of operators<span class="fst-italic"> (B<sub style="font-size: smaller;">sum.3PL</sub>) </span></p><p class="fst-italic">E<sub style="font-size: smaller;">total</sub> = B<sub style="font-size: smaller;">sum.3PL</sub> - B<sub style="font-size: smaller;">consolidated route</sub></p>';

const textEconomyWithFee =
    selectedLanguage === "ua"
        ? `<p>З загальної економії на маршруті, оператор стягує комісію за надання послуг. Щоб дізнатися комісію оператора <span class="fst-italic">(K<sub style="font-size: smaller;">опер</sub>)</span>, потрібно розділити загальну економію <span class="fst-italic">(E<sub style="font-size: smaller;">заг</sub>)</span> на кількість учасників маршруту <span class="fst-italic">(N<sub style="font-size: smaller;">уч.маршруту</sub>)</span> і оператора <span class="fst-italic">(O)</span>.</p>
    <p><span class="fst-italic">K<sub style="font-size: smaller;">опер</sub></span> = <span class="fst-italic">E<sub style="font-size: smaller;">заг</sub></span> / (<span class="fst-italic">N<sub style="font-size: smaller;">уч.маршруту</sub></span> + <span class="fst-italic">O</span>)</p>
    `
        : `<p>The operator's fee for the provision of services is charged from the total savings on the route. To find out the operator's fee <span class="fst-italic">(Fee<sub style="font-size: smaller;">oper</sub>)</span>, you need to divide the total savings <span class="fst-italic">(E<sub style="font-size: smaller;">total</sub>)</span> by the number of route participants <span class="fst-italic">(N<sub style="font-size: smaller;">route p.</sub>)</span> and the operator <span class="fst-italic">(O)</span></p>
    <p><span class="fst-italic">K<sub style="font-size: smaller;">oper</sub></span> = <span class="fst-italic">E<sub style="font-size: smaller;">total</sub></span> / (<span class="fst-italic">N<sub style="font-size: smaller;">route p.</sub></span> + <span class="fst-italic">O</span>)</p>
    `;
const textEconomyWithFee2 =
    selectedLanguage === "en"
        ? `<p>In order to find out the total savings after deducting the fee <span class="fst-italic">(E<sub style="font-size: smaller;">total with fee.</sub>)</span>, you need to subtract the operator's fee <span class="fst-italic">(Fee<sub style="font-size: smaller;">oper</sub>)</span> from the total savings <span class="fst-italic">(E<sub style="font-size: smaller;">total</sub>)</span></p>
    <p><span class="fst-italic">E<sub style="font-size: smaller;">total with fee</sub></span> = <span class="fst-italic">E<sub style="font-size: smaller;">total</sub></span> - <span class="fst-italic">Fee<sub style="font-size: smaller;">oper</sub></span></p>
    `
        : `<p>Для того, щоб дізнатися загальну економію з вирахуванням комісії <span class="fst-italic">(E<sub style="font-size: smaller;">заг з ком.</sub>)</span>, потрібно відняти від загальної економії <span class="fst-italic">(E<sub style="font-size: smaller;">заг</sub>)</span> комісію оператора <span class="fst-italic">(K<sub style="font-size: smaller;">опер</sub>)</span></p>
    <p><span class="fst-italic">E<sub style="font-size: smaller;">заг з ком.</sub></span> = <span class="fst-italic">E<sub style="font-size: smaller;">заг</sub></span> - <span class="fst-italic">K<sub style="font-size: smaller;">опер</sub></span></p>
    `;
const textEconomyPallets =
    selectedLanguage === "ua"
        ? `<p>Для того, щоб дізнатися суму економії на <span class="fst-italic">(Е<sub style="font-size: smaller;">пал</sub>)</span>, потрібно загальну економію з урахуванням комісії <span class="fst-italic">(E<sub style="font-size: smaller;">заг. з ком</sub>)</span>, розділити на загальну кількість палет у машин <span class="fst-italic">(N<sub style="font-size: smaller;">пал</sub>)</span></p><p class="fst-italic">Е<sub style="font-size: smaller;">пал</sub> = E<sub style="font-size: smaller;">заг. з ком</sub> - N<sub class="fst-italic" style="font-size: smaller;">пал</sub></p>
    `
        : `<p>To find out the amount of savings per pallet (E<sub style="font-size: smaller;">pal</sub>), you need to divide the total savings including fee (E<sub style="font-size: smaller;">total with fee</sub>) by the total number of pallets in the machine (N<sub style="font-size: smaller;">pal</sub>).</p>
<p class="fst-italic">
    E<sub style="font-size: smaller;">pal</sub> = E<sub style="font-size: smaller;">total with fee</sub> / N<sub style="font-size: smaller;">pal</sub>
</p>
`;

$("#block_i_calc_totaleconomy").empty();
$("#block_i_calc_totaleconomy").html(textInfoTotalEconomy);

$("#block_i_economy_w_fee").empty();
$("#block_i_economy_w_fee").html(textEconomyWithFee);
$("#block_i_economy_w_fee-2").empty();
$("#block_i_economy_w_fee-2").html(textEconomyWithFee2);

$("#block_i_saving_pallets").empty();
$("#block_i_saving_pallets").html(textEconomyPallets);
