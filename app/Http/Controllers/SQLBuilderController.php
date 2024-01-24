<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SQLBuilders\MysqlBuilder;
use App\SQLBuilders\PostgresBuilder;

class SQLBuilderController extends Controller
{
    public function index()
    {
        return view('sqlbuilder.index');
    }

    public function build(Request $request)
    {
        $builder = new MysqlBuilder();

        $table = $request->input('table');
        $fields = $request->input('fields');

        $whereConditions = [];
        $whereFields = $request->input('where.field', []);
        $whereValues = $request->input('where.value', []);
        $whereOperators = $request->input('where.operator', []);

        for ($i = 0; $i < count($whereFields); $i++) {
            if (isset($whereFields[$i], $whereValues[$i], $whereOperators[$i])) {
                $whereConditions[] = [
                    'field' => $whereFields[$i],
                    'value' => $whereValues[$i],
                    'operator' => $whereOperators[$i]
                ];
            }
        }

        $limitStart = $request->input('limit_start');
        $limitOffset = $request->input('limit_offset');

        $builder->select($table, $fields);

        foreach ($whereConditions as $condition) {
            $builder->where($condition['field'], $condition['value'], $condition['operator']);
        }

        $builder->limit($limitStart, $limitOffset);

        $query = $builder->getSQL();

        return response()->json([
            'query' => $query,
            'table' => $table,
            'fields' => $fields,
            'whereConditions' => $whereConditions ?? [],
            'limitStart' => $limitStart,
            'limitOffset' => $limitOffset,
        ]);
    }
}
