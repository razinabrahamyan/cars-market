-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 16 2021 г., 17:40
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Дамп данных таблицы `programs`
--

INSERT INTO `programs` (`id`, `brand_id`, `residual_values`, `money_factor`, `default_money_factor`, `fees`, `invoices`, `default_invoice`, `created_at`, `updated_at`) VALUES
    (1, 190, '{\"A\": [[\"A220W\", \"58%\", \"56%\", \"55%\", \"50%\", \"45%\", \"40%\", \"36%\", \"$43,800\", \"2021\"], [\"A220W4\", \"57%\", \"56%\", \"55%\", \"49%\", \"43%\", \"39%\", \"35%\", \"$46,000\", \"2021\"], [\"A35W4\", \"54%\", \"52%\", \"51%\", \"46%\", \"41%\", \"36%\", \"32%\", \"-\", \"2021\"], [\"A220W\", \"59%\", \"57%\", \"56%\", \"51%\", \"46%\", \"41%\", \"37%\", \"$44,100\", \"2022\"], [\"A220W4\", \"58%\", \"57%\", \"56%\", \"50%\", \"44%\", \"40%\", \"36%\", \"$46,300\", \"2022\"]], \"C\": [[\"C300W\", \"58%\", \"55%\", \"53%\", \"47%\", \"42%\", \"37%\", \"32%\", \"$52,000\", \"2021\"], [\"C300W4\", \"61%\", \"57%\", \"53%\", \"47%\", \"42%\", \"37%\", \"33%\", \"$54,100\", \"2021\"], [\"C43W4\", \"60%\", \"57%\", \"55%\", \"53%\", \"51%\", \"47%\", \"43%\", \"-\", \"2021\"], [\"C63W\", \"54%\", \"52%\", \"50%\", \"48%\", \"46%\", \"43%\", \"41%\", \"-\", \"2021\"], [\"C63WS\", \"51%\", \"49%\", \"47%\", \"45%\", \"43%\", \"41%\", \"39%\", \"-\", \"2021\"], [\"C300C\", \"55%\", \"52%\", \"50%\", \"45%\", \"41%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"C300C4\", \"55%\", \"52%\", \"50%\", \"45%\", \"41%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"C43C4\", \"56%\", \"54%\", \"52%\", \"50%\", \"48%\", \"45%\", \"42%\", \"-\", \"2021\"], [\"C63C\", \"53%\", \"50%\", \"48%\", \"46%\", \"45%\", \"42%\", \"40%\", \"-\", \"2021\"], [\"C63CS\", \"50%\", \"48%\", \"46%\", \"44%\", \"43%\", \"41%\", \"39%\", \"-\", \"2021\"], [\"C300A\", \"54%\", \"51%\", \"49%\", \"45%\", \"41%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"C300A4\", \"54%\", \"51%\", \"49%\", \"45%\", \"42%\", \"38%\", \"35%\", \"-\", \"2021\"], [\"C43A4\", \"53%\", \"51%\", \"49%\", \"47%\", \"45%\", \"42%\", \"40%\", \"-\", \"2021\"], [\"C63A\", \"50%\", \"48%\", \"46%\", \"44%\", \"43%\", \"41%\", \"39%\", \"-\", \"2021\"], [\"C63AS\", \"49%\", \"47%\", \"45%\", \"43%\", \"42%\", \"40%\", \"39%\", \"-\", \"2021\"], [\"C300C\", \"56%\", \"53%\", \"51%\", \"46%\", \"42%\", \"38%\", \"35%\", \"-\", \"2022\"], [\"C300C4\", \"56%\", \"53%\", \"51%\", \"46%\", \"42%\", \"38%\", \"35%\", \"-\", \"2022\"], [\"C43C4\", \"57%\", \"55%\", \"53%\", \"51%\", \"49%\", \"46%\", \"43%\", \"-\", \"2022\"], [\"C300A\", \"55%\", \"52%\", \"50%\", \"46%\", \"42%\", \"38%\", \"35%\", \"-\", \"2022\"], [\"C300A4\", \"55%\", \"52%\", \"50%\", \"46%\", \"43%\", \"39%\", \"36%\", \"-\", \"2022\"], [\"C43A4\", \"54%\", \"52%\", \"50%\", \"48%\", \"46%\", \"43%\", \"41%\", \"-\", \"2022\"]], \"E\": [[\"E350W\", \"60%\", \"56%\", \"53%\", \"48%\", \"44%\", \"39%\", \"34%\", \"$67,500\", \"2021\"], [\"E350W4\", \"58%\", \"55%\", \"52%\", \"47%\", \"43%\", \"38%\", \"34%\", \"$70,500\", \"2021\"], [\"E450W4\", \"61%\", \"57%\", \"54%\", \"50%\", \"46%\", \"44%\", \"42%\", \"$77,600\", \"2021\"], [\"E53W4\", \"58%\", \"55%\", \"53%\", \"50%\", \"48%\", \"45%\", \"42%\", \"-\", \"2021\"], [\"E63W4S\", \"54%\", \"51%\", \"48%\", \"44%\", \"41%\", \"39%\", \"37%\", \"-\", \"2021\"], [\"E450C\", \"52%\", \"51%\", \"50%\", \"44%\", \"38%\", \"34%\", \"31%\", \"-\", \"2021\"], [\"E450C4\", \"52%\", \"51%\", \"50%\", \"43%\", \"37%\", \"33%\", \"30%\", \"-\", \"2021\"], [\"E53C4\", \"59%\", \"56%\", \"53%\", \"50%\", \"48%\", \"45%\", \"42%\", \"-\", \"2021\"], [\"E450A\", \"54%\", \"52%\", \"50%\", \"46%\", \"43%\", \"39%\", \"36%\", \"-\", \"2021\"], [\"E450A4\", \"54%\", \"52%\", \"51%\", \"47%\", \"43%\", \"40%\", \"37%\", \"-\", \"2021\"], [\"E53A4\", \"59%\", \"56%\", \"54%\", \"51%\", \"49%\", \"46%\", \"44%\", \"-\", \"2021\"], [\"E450S4\", \"57%\", \"54%\", \"51%\", \"45%\", \"40%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"E63S4S\", \"54%\", \"51%\", \"49%\", \"47%\", \"46%\", \"44%\", \"42%\", \"-\", \"2021\"], [\"E350W\", \"61%\", \"57%\", \"54%\", \"49%\", \"45%\", \"40%\", \"35%\", \"$68,200\", \"2022\"], [\"E350W4\", \"59%\", \"56%\", \"53%\", \"48%\", \"44%\", \"39%\", \"35%\", \"$71,200\", \"2022\"], [\"E450W4\", \"62%\", \"58%\", \"55%\", \"51%\", \"47%\", \"45%\", \"43%\", \"$78,350\", \"2022\"], [\"E53W4\", \"59%\", \"56%\", \"54%\", \"51%\", \"49%\", \"46%\", \"43%\", \"-\", \"2022\"], [\"E450C\", \"53%\", \"52%\", \"51%\", \"45%\", \"39%\", \"35%\", \"32%\", \"-\", \"2022\"], [\"E450C4\", \"53%\", \"52%\", \"51%\", \"44%\", \"38%\", \"34%\", \"31%\", \"-\", \"2022\"], [\"E53C4\", \"60%\", \"57%\", \"54%\", \"51%\", \"49%\", \"46%\", \"43%\", \"-\", \"2022\"], [\"E450A\", \"55%\", \"53%\", \"51%\", \"47%\", \"44%\", \"40%\", \"37%\", \"-\", \"2022\"], [\"E450A4\", \"55%\", \"53%\", \"52%\", \"48%\", \"44%\", \"41%\", \"38%\", \"-\", \"2022\"], [\"E53A4\", \"60%\", \"57%\", \"55%\", \"52%\", \"50%\", \"47%\", \"45%\", \"-\", \"2022\"], [\"E450S4\", \"58%\", \"55%\", \"52%\", \"46%\", \"41%\", \"38%\", \"35%\", \"-\", \"2022\"]], \"G\": [[\"G550W4\", \"58%\", \"54%\", \"51%\", \"47%\", \"43%\", \"39%\", \"36%\", \"-\", \"2021\"], [\"G63W4\", \"63%\", \"59%\", \"55%\", \"51%\", \"48%\", \"43%\", \"38%\", \"-\", \"2021\"]], \"S\": [[\"S500V4\", \"58%\", \"53%\", \"49%\", \"44%\", \"40%\", \"36%\", \"32%\", \"-\", \"2021\"], [\"S580V4\", \"56%\", \"51%\", \"47%\", \"43%\", \"40%\", \"36%\", \"33%\", \"-\", \"2021\"], [\"S580Z4\", \"48%\", \"44%\", \"41%\", \"38%\", \"36%\", \"34%\", \"32%\", \"-\", \"2021\"], [\"S560C4\", \"52%\", \"45%\", \"39%\", \"36%\", \"33%\", \"29%\", \"26%\", \"-\", \"2021\"], [\"S63C4\", \"51%\", \"45%\", \"39%\", \"35%\", \"32%\", \"29%\", \"26%\", \"-\", \"2021\"], [\"S560A\", \"52%\", \"48%\", \"44%\", \"40%\", \"37%\", \"33%\", \"29%\", \"-\", \"2021\"], [\"S63A4\", \"50%\", \"44%\", \"39%\", \"36%\", \"34%\", \"30%\", \"27%\", \"-\", \"2021\"], [\"S500V4\", \"59%\", \"54%\", \"50%\", \"45%\", \"41%\", \"37%\", \"33%\", \"-\", \"2022\"]], \"GT\": [[\"GT\", \"55%\", \"52%\", \"50%\", \"45%\", \"41%\", \"38%\", \"36%\", \"-\", \"2021\"], [\"GTC\", \"52%\", \"49%\", \"46%\", \"42%\", \"39%\", \"37%\", \"36%\", \"-\", \"2021\"], [\"GTBS\", \"45%\", \"44%\", \"43%\", \"42%\", \"41%\", \"40%\", \"39%\", \"-\", \"2021\"], [\"GTA\", \"54%\", \"51%\", \"48%\", \"44%\", \"40%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"GTCA\", \"51%\", \"49%\", \"47%\", \"43%\", \"40%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"GT43C4\", \"58%\", \"55%\", \"53%\", \"48%\", \"44%\", \"41%\", \"39%\", \"-\", \"2021\"], [\"GT53C4\", \"57%\", \"54%\", \"52%\", \"47%\", \"43%\", \"40%\", \"38%\", \"-\", \"2021\"], [\"GT63C4\", \"54%\", \"51%\", \"48%\", \"44%\", \"40%\", \"37%\", \"35%\", \"-\", \"2021\"], [\"GT63C4S\", \"52%\", \"49%\", \"46%\", \"42%\", \"38%\", \"35%\", \"33%\", \"-\", \"2021\"], [\"GT43C4\", \"59%\", \"56%\", \"54%\", \"49%\", \"45%\", \"42%\", \"40%\", \"-\", \"2022\"], [\"GT53C4\", \"58%\", \"55%\", \"53%\", \"48%\", \"44%\", \"41%\", \"39%\", \"-\", \"2022\"]], \"CLA\": [[\"CLA250C\", \"57%\", \"55%\", \"54%\", \"48%\", \"42%\", \"40%\", \"38%\", \"$48,900\", \"2021\"], [\"CLA250C4\", \"57%\", \"55%\", \"54%\", \"48%\", \"42%\", \"40%\", \"38%\", \"$51,100\", \"2021\"], [\"CLA35C4\", \"55%\", \"53%\", \"52%\", \"46%\", \"41%\", \"38%\", \"36%\", \"-\", \"2021\"], [\"CLA45C4\", \"58%\", \"53%\", \"49%\", \"46%\", \"43%\", \"39%\", \"35%\", \"-\", \"2021\"], [\"CLA250C\", \"58%\", \"56%\", \"55%\", \"49%\", \"43%\", \"41%\", \"39%\", \"$49,250\", \"2022\"], [\"CLA250C4\", \"58%\", \"56%\", \"55%\", \"49%\", \"43%\", \"41%\", \"39%\", \"$51,450\", \"2022\"], [\"CLA35C4\", \"56%\", \"54%\", \"53%\", \"47%\", \"42%\", \"39%\", \"37%\", \"-\", \"2022\"]], \"CLS\": [[\"CLS450C\", \"56%\", \"52%\", \"48%\", \"43%\", \"39%\", \"35%\", \"31%\", \"-\", \"2021\"], [\"CLS450C4\", \"57%\", \"52%\", \"48%\", \"43%\", \"39%\", \"35%\", \"31%\", \"-\", \"2021\"], [\"CLS53C4\", \"57%\", \"52%\", \"47%\", \"43%\", \"40%\", \"35%\", \"31%\", \"-\", \"2021\"], [\"CLS450C4\", \"58%\", \"53%\", \"49%\", \"44%\", \"40%\", \"36%\", \"32%\", \"-\", \"2022\"]], \"GLA\": [[\"GLA250W\", \"62%\", \"59%\", \"56%\", \"51%\", \"47%\", \"42%\", \"37%\", \"$47,000\", \"2021\"], [\"GLA250W4\", \"62%\", \"59%\", \"56%\", \"51%\", \"47%\", \"42%\", \"37%\", \"$49,200\", \"2021\"], [\"GLA35W4\", \"58%\", \"57%\", \"56%\", \"52%\", \"48%\", \"42%\", \"37%\", \"-\", \"2021\"], [\"GLA45W4\", \"58%\", \"55%\", \"53%\", \"50%\", \"47%\", \"45%\", \"43%\", \"-\", \"2021\"], [\"GLA250W\", \"63%\", \"60%\", \"57%\", \"52%\", \"48%\", \"43%\", \"38%\", \"$47,170\", \"2022\"], [\"GLA250W4\", \"63%\", \"60%\", \"57%\", \"52%\", \"48%\", \"43%\", \"38%\", \"$49,370\", \"2022\"], [\"GLA35W4\", \"59%\", \"58%\", \"57%\", \"53%\", \"49%\", \"43%\", \"38%\", \"-\", \"2022\"]], \"GLB\": [[\"GLB250W\", \"60%\", \"57%\", \"54%\", \"49%\", \"45%\", \"40%\", \"35%\", \"$50,700\", \"2021\"], [\"GLB250W4\", \"60%\", \"57%\", \"54%\", \"49%\", \"45%\", \"40%\", \"35%\", \"$52,700\", \"2021\"], [\"GLB35W4\", \"61%\", \"58%\", \"55%\", \"52%\", \"49%\", \"45%\", \"42%\", \"-\", \"2021\"], [\"GLB250W\", \"61%\", \"58%\", \"55%\", \"50%\", \"46%\", \"42%\", \"38%\", \"$51,250\", \"2022\"], [\"GLB250W4\", \"61%\", \"58%\", \"55%\", \"51%\", \"47%\", \"42%\", \"38%\", \"$53,250\", \"2022\"], [\"GLB35W4\", \"62%\", \"59%\", \"56%\", \"53%\", \"51%\", \"47%\", \"44%\", \"-\", \"2022\"]], \"GLC\": [[\"GLC300W\", \"61%\", \"57%\", \"53%\", \"47%\", \"42%\", \"39%\", \"37%\", \"$53,400\", \"2021\"], [\"GLC300W4\", \"58%\", \"54%\", \"51%\", \"46%\", \"42%\", \"38%\", \"35%\", \"$56,900\", \"2021\"], [\"GLC43W4\", \"58%\", \"54%\", \"51%\", \"49%\", \"47%\", \"44%\", \"42%\", \"-\", \"2021\"], [\"GLC63W4\", \"54%\", \"51%\", \"48%\", \"46%\", \"44%\", \"42%\", \"40%\", \"-\", \"2021\"], [\"GLC300C4\", \"60%\", \"55%\", \"51%\", \"49%\", \"48%\", \"45%\", \"42%\", \"-\", \"2021\"], [\"GLC43C4\", \"57%\", \"53%\", \"50%\", \"47%\", \"45%\", \"43%\", \"42%\", \"-\", \"2021\"], [\"GLC63C4\", \"54%\", \"51%\", \"49%\", \"47%\", \"45%\", \"43%\", \"41%\", \"-\", \"2021\"], [\"GLC63C4S\", \"53%\", \"50%\", \"47%\", \"45%\", \"44%\", \"42%\", \"40%\", \"-\", \"2021\"], [\"GLC300W\", \"62%\", \"58%\", \"54%\", \"48%\", \"43%\", \"40%\", \"38%\", \"$54,050\", \"2022\"], [\"GLC300W4\", \"59%\", \"55%\", \"52%\", \"47%\", \"43%\", \"39%\", \"36%\", \"$57,550\", \"2022\"], [\"GLC300C4\", \"61%\", \"56%\", \"52%\", \"50%\", \"49%\", \"46%\", \"43%\", \"-\", \"2022\"]], \"GLE\": [[\"GLE350W\", \"60%\", \"56%\", \"53%\", \"48%\", \"43%\", \"39%\", \"36%\", \"-\", \"2021\"], [\"GLE350W4\", \"60%\", \"56%\", \"53%\", \"48%\", \"43%\", \"39%\", \"36%\", \"-\", \"2021\"], [\"GLE450W4\", \"60%\", \"56%\", \"53%\", \"49%\", \"46%\", \"42%\", \"38%\", \"-\", \"2021\"], [\"GLE580W4\", \"53%\", \"50%\", \"47%\", \"44%\", \"42%\", \"39%\", \"36%\", \"-\", \"2021\"], [\"GLE53W4\", \"58%\", \"55%\", \"53%\", \"48%\", \"43%\", \"40%\", \"37%\", \"-\", \"2021\"], [\"GLE63W4S\", \"50%\", \"48%\", \"46%\", \"44%\", \"42%\", \"39%\", \"37%\", \"-\", \"2021\"], [\"GLE53C4\", \"57%\", \"54%\", \"51%\", \"48%\", \"45%\", \"42%\", \"39%\", \"-\", \"2021\"], [\"GLE63C4S\", \"53%\", \"51%\", \"50%\", \"47%\", \"45%\", \"43%\", \"41%\", \"-\", \"2021\"], [\"GLE350W\", \"61%\", \"57%\", \"54%\", \"49%\", \"44%\", \"40%\", \"37%\", \"-\", \"2022\"], [\"GLE350W4\", \"61%\", \"57%\", \"54%\", \"49%\", \"44%\", \"40%\", \"37%\", \"-\", \"2022\"], [\"GLE450W4\", \"61%\", \"57%\", \"54%\", \"50%\", \"47%\", \"43%\", \"39%\", \"-\", \"2022\"], [\"GLE53W4\", \"59%\", \"56%\", \"54%\", \"49%\", \"44%\", \"41%\", \"38%\", \"-\", \"2022\"], [\"GLE53C4\", \"58%\", \"55%\", \"52%\", \"49%\", \"46%\", \"43%\", \"40%\", \"-\", \"2022\"]], \"GLS\": [[\"GLS450W4\", \"59%\", \"55%\", \"52%\", \"47%\", \"43%\", \"38%\", \"34%\", \"-\", \"2021\"], [\"GLS580W4\", \"54%\", \"51%\", \"48%\", \"44%\", \"41%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"GLS63W4\", \"50%\", \"47%\", \"45%\", \"42%\", \"40%\", \"37%\", \"34%\", \"-\", \"2021\"], [\"GLS600Z4\", \"46%\", \"43%\", \"41%\", \"39%\", \"37%\", \"35%\", \"33%\", \"-\", \"2021\"], [\"GLS450W4\", \"60%\", \"56%\", \"53%\", \"48%\", \"44%\", \"39%\", \"35%\", \"-\", \"2022\"]], \"fields\": [\"Model\", \"24\", \"30\", \"36\", \"42\", \"48\", \"54\", \"60\", \"MRM\", \"Model Year\"], \"values_adjustments\": {\"miles\": [\"7,500\", \"10,000\", \"12,000\", \"20,000\"], \"terms\": [\"24 - 60 months\", \"all terms\", \"all terms\", \"24 - 48 months\"], \"action\": [\"add\", \"add\", \"add\", \"subtract\"], \"percent\": [\"4%\", \"3%\", \"2%\", \"5%\"]}}', '{\"2021\": {\"GT\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GTA\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GTC\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GTR\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63A\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63C\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63W\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GTBS\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GTCA\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"A220W\": {\"A1_T1\": \"0.00108\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"A35W4\": {\"A1_T1\": \"0.00092\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300A\": {\"A1_T1\": \"0.00079\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300C\": {\"A1_T1\": \"0.00126\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300W\": {\"A1_T1\": \"0.00056\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C43A4\": {\"A1_T1\": \"0.00088\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C43C4\": {\"A1_T1\": \"0.00102\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C43W4\": {\"A1_T1\": \"0.00133\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63AS\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63CS\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C63WS\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E350W\": {\"A1_T1\": \"0.00097\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450A\": {\"A1_T1\": \"0.00072\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450C\": {\"A1_T1\": \"0.00041\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53A4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"G63W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S560A\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S63A4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S63C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"A220W4\": {\"A1_T1\": \"0.00105\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300A4\": {\"A1_T1\": \"0.00075\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300C4\": {\"A1_T1\": \"0.00117\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300W4\": {\"A1_T1\": \"0.00058\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E350W4\": {\"A1_T1\": \"0.00067\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450A4\": {\"A1_T1\": \"0.00083\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450C4\": {\"A1_T1\": \"0.00034\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450S4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450W4\": {\"A1_T1\": \"0.00144\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E63S4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E63W4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"G550W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT43C4\": {\"A1_T1\": \"0.00142\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT53C4\": {\"A1_T1\": \"0.00142\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT63C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S500V4\": {\"A1_T1\": \"0.00139\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S560C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S580V4\": {\"A1_T1\": \"0.00139\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"S580Z4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA250C\": {\"A1_T1\": \"0.00084\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA35C4\": {\"A1_T1\": \"0.00097\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA45C4\": {\"A1_T1\": \"0.00108\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLS450C\": {\"A1_T1\": \"0.00072\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLS53C4\": {\"A1_T1\": \"0.00086\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA250W\": {\"A1_T1\": \"0.00094\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA35W4\": {\"A1_T1\": \"0.00143\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA45W4\": {\"A1_T1\": \"0.00143\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB250W\": {\"A1_T1\": \"0.00105\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB35W4\": {\"A1_T1\": \"0.00107\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300W\": {\"A1_T1\": \"0.00099\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC43C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC43W4\": {\"A1_T1\": \"0.00124\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC63C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC63W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE350W\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE53C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE53W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT63C4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA250C4\": {\"A1_T1\": \"0.00084\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLS450C4\": {\"A1_T1\": \"0.00104\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA250W4\": {\"A1_T1\": \"0.00086\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB250W4\": {\"A1_T1\": \"0.00106\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300W4\": {\"A1_T1\": \"0.00058\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC63C4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE350W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE450W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE580W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE63C4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE63W4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLS450W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLS580W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLS600Z4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLS63W4S\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}}, \"2022\": {\"A220W\": {\"A1_T1\": \"0.00145\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300A\": {\"A1_T1\": \"0.00110\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300C\": {\"A1_T1\": \"0.00145\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C43A4\": {\"A1_T1\": \"0.00104\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C43C4\": {\"A1_T1\": \"0.00119\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E350W\": {\"A1_T1\": \"0.00128\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450A\": {\"A1_T1\": \"0.00092\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450C\": {\"A1_T1\": \"0.00064\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53A4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E53W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"A220W4\": {\"A1_T1\": \"0.00140\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300A4\": {\"A1_T1\": \"0.00106\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"C300C4\": {\"A1_T1\": \"0.00145\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E350W4\": {\"A1_T1\": \"0.00098\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450A4\": {\"A1_T1\": \"0.00103\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450C4\": {\"A1_T1\": \"0.00057\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450S4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"E450W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT43C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GT53C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA250C\": {\"A1_T1\": \"0.00116\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA35C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA250W\": {\"A1_T1\": \"0.00139\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA35W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB250W\": {\"A1_T1\": \"0.00144\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB35W4\": {\"A1_T1\": \"0.00141\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300W\": {\"A1_T1\": \"0.00133\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE350W\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE53C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE53W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"CLA250C4\": {\"A1_T1\": \"0.00115\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLA250W4\": {\"A1_T1\": \"0.00130\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLB250W4\": {\"A1_T1\": \"0.00143\", \"fleetIncentive\": \"500\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300C4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLC300W4\": {\"A1_T1\": \"0.00093\", \"fleetIncentive\": \"750\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE350W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}, \"GLE450W4\": {\"A1_T1\": \"std.\", \"fleetIncentive\": \"1000\", \"incentiveBonus\": \"\", \"leaseBonusCash\": \"\"}}}', 0.0018, '{\"basicFees\": {\"DMVFee\": 275, \"DocFee\": 175, \"BankFee\": 1095, \"TierTax\": 12.5, \"GasCharge\": 45, \"Inspection\": 10}, \"invoiceFees\": {\"FreightFee\": 1050, \"FreightFeeExtra\": 40}}', '{\"A\": \"\", \"C\": \"95.50\", \"E\": \"\", \"G\": \"\", \"S\": \"94.50\", \"GT\": \"\", \"CLA\": \"95.50\", \"CLS\": \"\", \"GLA\": \"95.50\", \"GLB\": \"95.70\", \"GLC\": \"95.50\", \"GLE\": \"95\", \"GLS\": \"95\"}', 95.50, '2021-10-11 03:10:30', '2021-10-21 05:03:32');

COMMIT;

