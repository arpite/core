<?php

use Arpite\Component\Components\Chart\Chart;
use Arpite\Component\Components\Chart\DataSet;
use Arpite\Component\Components\Chart\Enums\DataColor;
use Arpite\Component\Components\Chart\Enums\DataType;

it("should have initial export", function () {
	expect(Chart::make()->export())->toBe([
		"nodeType" => "Chart",
		"dataSets" => [],
		"labels" => [],
		"dataType" => DataType::NUMBERS,
		"xAxisLabel" => null,
		"yAxisLabel" => null,
		"stacked" => false,
		"height" => 320,
		"legendPosition" => "right",
	]);
});

it("can set labels", function () {
	expect(
		Chart::make()
			->setLabels(["Amazon", "Google"])
			->export()
	)->toHaveKey("labels", ["Amazon", "Google"]);
});

it("can show as stacked", function () {
	expect(
		Chart::make()
			->asStacked()
			->export()
	)->toHaveKey("stacked", true);
});

it("can set Y axis label", function () {
	expect(
		Chart::make()
			->setYAxisLabel("Y")
			->export()
	)->toHaveKey("yAxisLabel", "Y");
});

it("can set X axis label", function () {
	expect(
		Chart::make()
			->setXAxisLabel("X")
			->export()
	)->toHaveKey("xAxisLabel", "X");
});

it("can set data type", function () {
	expect(
		Chart::make()
			->setDataType(DataType::CURRENCY)
			->export()
	)->toHaveKey("dataType", DataType::CURRENCY);
});

it("can set data sets", function () {
	expect(
		Chart::make()
			->setDataSets([
				DataSet::make("Q1")
					->setData([10, 10])
					->setBackgroundColor(DataColor::SEQUENTIAL_10_GREENS[1]),
			])
			->export()
	)->toHaveKey("dataSets", [
		[
			"label" => "Q1",
			"data" => [10, 10],
			"backgroundColor" => "#d3eecd",
		],
	]);
});
