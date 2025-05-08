<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional rolling door calculator for optimal material calculation">
    <title>Professional Door Calculator | QLBM Systems</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <div class="logo-container">
                <i class="fas fa-door-open logo-icon"></i>
                <h1>Professional Door Calculator</h1>
            </div>
            <p class="tagline">Fast & Accurate Material Calculations for Rolling Doors</p>
        </header>

        <section class="calculator-form">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-ruler-combined"></i> Door Dimensions</h2>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="doorWidth">
                                <i class="fas fa-arrows-alt-h"></i> Qapı Eni (metr):
                            </label>
                            <input type="number" id="doorWidth" step="0.05" min="0" value="3" 
                                class="form-control">
                        </div>

                        <div class="input-group">
                            <label for="doorHeight">
                                <i class="fas fa-arrows-alt-v"></i> Qapı Hündürlüyü (metr):
                            </label>
                            <input type="number" id="doorHeight" step="0.05" min="0" value="3" 
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-palette"></i> Color Selection</h2>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="colorCategory">
                                <i class="fas fa-layer-group"></i> Rəng Kateqoriyası:
                            </label>
                            <select id="colorCategory" onchange="updateColorOptions()" class="form-control">
                                <option value="standard">Düz Rənglər</option>
                                <option value="furniture">Mebel Rəngləri</option>
                                <option value="premium">Qoz və Vişnə Rəngləri</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="colorName">
                                <i class="fas fa-fill-drip"></i> Rəng Seçimi:
                            </label>
                            <select id="colorName" onchange="updateAvailableLengths()" class="form-control">
                                <!-- Will be populated by JavaScript -->
                            </select>
                        </div>
                    </div>

                    <div class="color-info-container">
                        <div class="color-info" id="colorInfo">
                            <!-- Price and availability info will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="calculation-rules">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Hesablama Qaydaları</h2>
                    </div>
                    <div class="card-body">
                        <ul class="rule-list">
                            <li><i class="fas fa-arrow-right"></i> <strong>Direk:</strong> Qapı hündürlüyü ≤ 3 metr: (Hündürlük - 0.30) × 2, > 3 metr: (Hündürlük - 0.35) × 2</li>
                            <li><i class="fas fa-arrow-right"></i> <strong>Palet:</strong> Qapının eni 3 metr və daha çox olduqda 10 sm çıxılır</li>
                            <li><i class="fas fa-arrow-right"></i> <strong>Kassa:</strong> Qapı hündürlüyü ≤ 2.95 metr olduqda 30-luq, > 2.95 metr olduqda 35-lik</li>
                            <li><i class="fas fa-arrow-right"></i> <strong>Otxot qaydası:</strong> Paletlər üçün 65 sm-dən çox otxot olduqda, miqdarı 5 AZN/metr ilə vurularaq ümumi qiymətdən çıxılır</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="calculate-button-container">
                <button onclick="calculate()" class="calculate-button">
                    <i class="fas fa-calculator"></i> Hesabla
                </button>
            </div>
        </section>

        <section class="results-section">
            <div class="summary-grid">
                <div class="summary-box">
                    <i class="fas fa-money-bill-wave summary-icon"></i>
                    <h3>Ümumi məbləğ</h3>
                    <p id="totalCost" class="summary-value">0.00 ₼</p>
                </div>
                <div class="summary-box">
                    <i class="fas fa-ruler summary-icon"></i>
                    <h3>Palet uzunluğu</h3>
                    <p id="paletCalculation" class="summary-value">0.00 m</p>
                </div>
                <div class="summary-box">
                    <i class="fas fa-ruler-vertical summary-icon"></i>
                    <h3>Direk uzunluğu</h3>
                    <p id="direkLength" class="summary-value">0.00 m</p>
                </div>
                <div class="summary-box">
                    <i class="fas fa-box summary-icon"></i>
                    <h3>Kassa növü</h3>
                    <p id="kassaType" class="summary-value">30-luq</p>
                </div>
            </div>

            <div class="tab-container">
                <div class="tab-buttons">
                    <button class="tab-button active" onclick="openTab(event, 'detailsTab')">
                        <i class="fas fa-list-ul"></i> Material Detalları
                    </button>
                    <button class="tab-button" onclick="openTab(event, 'calculationsTab')">
                        <i class="fas fa-calculator"></i> Hesablama Detalları
                    </button>
                    <button class="tab-button" onclick="openTab(event, 'optimizationTab')">
                        <i class="fas fa-chart-line"></i> Material Optimizasiyası
                    </button>
                </div>

                <div id="detailsTab" class="tab-content active">
                    <h2 class="tab-title"><i class="fas fa-clipboard-list"></i> Material Hesablaması</h2>
                    <div class="table-responsive">
                        <table id="materialsTable" class="data-table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Vahid qiymət</th>
                                    <th>Miqdar</th>
                                    <th>Cəmi</th>
                                    <th>Qeyd</th>
                                </tr>
                            </thead>
                            <tbody id="materialsBody">
                                <!-- Will be filled by JavaScript -->
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="3">Ümumi məbləğ:</td>
                                    <td id="totalCostDetail">0.00 ₼</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div id="calculationsTab" class="tab-content">
                    <h2 class="tab-title"><i class="fas fa-square-root-alt"></i> Hesablama Metodologiyası</h2>
                    
                    <div class="calculation-card">
                        <div class="calculation-explanation" id="paletExplanation">
                            <!-- Palet calculation explanation will be inserted here -->
                        </div>
                    </div>

                    <div class="calculation-card">
                        <div class="calculation-explanation" id="direkExplanation">
                            <!-- Direk calculation explanation will be inserted here -->
                        </div>
                    </div>

                    <div class="calculation-card">
                        <div class="calculation-explanation" id="kassaExplanation">
                            <!-- Kassa calculation explanation will be inserted here -->
                        </div>
                    </div>

                    <div class="calculation-card">
                        <div class="calculation-explanation" id="wastageExplanation">
                            <!-- Wastage calculation explanation will be inserted here -->
                        </div>
                    </div>
                </div>

                <div id="optimizationTab" class="tab-content">
                    <h2 class="tab-title"><i class="fas fa-cogs"></i> Optimal Material Seçimi</h2>
                    <p class="optimization-description">Aşağıdakı cədvəl material istifadəsinin ən optimal variantını göstərir</p>
                    
                    <div class="table-responsive">
                        <table id="optimalTable" class="data-table optimization-table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Uzunluq</th>
                                    <th>Miqdar</th>
                                    <th>İtki</th>
                                    <th>Otxot dəyəri</th>
                                </tr>
                            </thead>
                            <tbody id="optimalBody">
                                <!-- Will be filled by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <footer class="main-footer">
            <p>Professional Door Calculator &copy; 2025 | QLBM Systems</p>
            <p class="version">Version 2.5.0</p>
        </footer>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>