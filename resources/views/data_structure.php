<?php

class Node
{
    private int $data;
    public ?Node $next;
    public ?Node $prev;

    public function __construct(int $data)
    {
        $this->data  = $data;
    }

    static function countNodes(Node $head): int
    {
        $count = 1;
        $current  = $head;

        if ($current->next !== null) {
            $current = $current->next;
            $count += 1;
        }

        return $count;
    }
}

// 4,2,3,10,2
$n1 = new Node(4);
$n2 = new Node(2);

$n1->next = $n2;
print_r($n1);
