<div class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div>
            <div class="max-w-sm w-full lg:max-w-full lg:flex">
                <div class="h-48 lg:h-auto lg:w-auto flex-none rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                    <img class="w-auto h-full" src="{{ url('storage/images/'.$company->logo) }}" alt="{{ $company->name }}">
                </div>
                <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-5">
                        <div class="mb-5">
                            <a href="{{ route('dashboard') }}" class="text-gray-900">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                                    </svg>

                                    <span class="ml-2">Back</span>
                                </div>
                              </a>
                        </div>
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $company->name }}</div>
                        <p class="text-gray-700 text-base mb-2">{{ $company->description }}</p>
                        <p class="text-gray-700 text-base">Address: <span class="font-bold">{{ $company->address }}</span></p>
                    </div>
                    <div class="pb-2">
                        <span class="text-gray-900 font-bold">Stock Price</span>
                        @if (!is_null($stockPrice))
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Company</th>
                                        <th scope="col" class="px-6 py-3">Volume</th>
                                        <th scope="col" class="px-6 py-3">Open</th>
                                        <th scope="col" class="px-6 py-3">High</th>
                                        <th scope="col" class="px-6 py-3">Low</th>
                                        <th scope="col" class="px-6 py-3">Close</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        @foreach ($stockPrice['results'] as $price)
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $stockPrice['ticker'] }}</td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ number_format($price['v']) }}</td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $price['o'] }}</td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $price['h'] }}</td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $price['l'] }}</td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $price['c'] }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="pt-2">
                        <span class="text-gray-900 font-bold">Financial Statements</span>
                        @if (!is_null($financials))
                            <div class="max-h-96 overflow-y-scroll">
                                <div class="bg-gray-200 border-l-4 border-t-1 border-r-1 border-b-1 border-gray-900 text-gray-700 p-4" role="alert">
                                    <p class="font-bold">{{ $financials['company_name'] }}</p>
                                    <p>Fiscal Year and Period: <span class="font-bold">{{ $financials['fiscal_year'] }} - {{ $financials['fiscal_period'] }}</span></p>
                                    <p>Date: <span class="font-bold">{{ $financials['start_date'] }}</span> - <span class="font-bold">{{ $financials['end_date'] }}</span></p>
                                    <div class="bg-gray-200 border-t-4 border-gray-900 rounded-b text-teal-900 px-4 py-3 shadow-md mt-2" role="alert">
                                        <div>
                                            <p class="font-bold border-gray-500 border-b-2 pb-3 mb-3">Cashflow Statements</p>
                                            <p class="text-md">
                                                {{ $financials['financials']['cash_flow_statement']['net_cash_flow']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['cash_flow_statement']['net_cash_flow']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['cash_flow_statement']['net_cash_flow_from_operating_activities']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['cash_flow_statement']['net_cash_flow_from_operating_activities']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['cash_flow_statement']['net_cash_flow_from_investing_activities']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['cash_flow_statement']['net_cash_flow_from_investing_activities']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['cash_flow_statement']['net_cash_flow_from_financing_activities']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['cash_flow_statement']['net_cash_flow_from_financing_activities']['value']) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 border-t-4 border-gray-900 rounded-b text-teal-900 px-4 py-3 shadow-md mt-5" role="alert">
                                        <div>
                                            <p class="font-bold border-gray-500 border-b-2 pb-3 mb-3">Balance Sheets</p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['current_assets']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['current_assets']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['wages']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['wages']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['current_liabilities']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['current_liabilities']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['accounts_payable']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['accounts_payable']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['equity_attributable_to_noncontrolling_interest']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['equity_attributable_to_noncontrolling_interest']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['liabilities_and_equity']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['liabilities_and_equity']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['assets']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['assets']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['intangible_assets']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['intangible_assets']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['liabilities']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['liabilities']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['inventory']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['inventory']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['long_term_debt']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['long_term_debt']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['balance_sheet']['equity']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['balance_sheet']['equity']['value']) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 border-t-4 border-gray-900 rounded-b text-teal-900 px-4 py-3 shadow-md mt-5" role="alert">
                                        <div>
                                            <p class="font-bold border-gray-500 border-b-2 pb-3 mb-3">Income Statements</p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['operating_expenses']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['operating_expenses']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['basic_earnings_per_share']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['basic_earnings_per_share']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['gross_profit']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['gross_profit']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['revenues']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['revenues']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['net_income_loss']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['net_income_loss']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['operating_income_loss']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['operating_income_loss']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['basic_average_shares']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['basic_average_shares']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['income_loss_from_equity_method_investments']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['income_loss_from_equity_method_investments']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['net_income_loss_attributable_to_noncontrolling_interest']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['net_income_loss_attributable_to_noncontrolling_interest']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['benefits_costs_expenses']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['benefits_costs_expenses']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['cost_of_revenue']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['cost_of_revenue']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['costs_and_expenses']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['costs_and_expenses']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['nonoperating_income_loss']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['nonoperating_income_loss']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['income_statement']['income_tax_expense_benefit']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['income_statement']['income_tax_expense_benefit']['value']) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bg-gray-200 border-t-4 border-gray-900 rounded-b text-teal-900 px-4 py-3 shadow-md mt-5" role="alert">
                                        <div>
                                            <p class="font-bold border-gray-500 border-b-2 pb-3 mb-3">Comprehensive Income Statements</p>
                                            <p class="text-md">
                                                {{ $financials['financials']['comprehensive_income']['comprehensive_income_loss_attributable_to_parent']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['comprehensive_income']['comprehensive_income_loss_attributable_to_parent']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['comprehensive_income']['comprehensive_income_loss']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['comprehensive_income']['comprehensive_income_loss']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['comprehensive_income']['other_comprehensive_income_loss']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['comprehensive_income']['other_comprehensive_income_loss']['value']) }}
                                                </span>
                                            </p>
                                            <p class="text-md">
                                                {{ $financials['financials']['comprehensive_income']['comprehensive_income_loss_attributable_to_noncontrolling_interest']['label'] }}:
                                                <span class="font-bold">
                                                    ${{ number_format($financials['financials']['comprehensive_income']['comprehensive_income_loss_attributable_to_noncontrolling_interest']['value']) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
