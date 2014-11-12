<?php 

class ModelEloquent extends Eloquent
{

	protected $globalModel;
	protected $attributeNames;
	protected $mainAttributes;
    protected $relationsArray;

    public function isRelation($key)
    {
        if(is_array($this->getRelationsArray()))
        {
            if(array_key_exists($key, $this->getRelationsArray()))
            {
                return $this->getRelationsArray()[$key];
            }
        }
        return false;
    }

    public function getRelationsArray()
    {
        return $this->relationsArray;
    }

    public function value($key)
    {
        if($relation = $this->isRelation($key))
        {
            return $this->{$relation.'_value'};
        }
        else
        {
           return $this->getAttribute($key);
        }
    } 

    public function getAttributeType($key)
    {
        $attribute = $this->getAttribute($key);
        if(array_key_exists($key, $this->getDates()))
        {
            return 'date';
        }
        else if(File::isFile($attribute) || File::exists($attribute))
        {
            return File::extension($attribute);
        }
        else
        {
            return 'string';
        }
    }

    public function setAttributeNames($attributeNames)
    {
        $this->attributeNames = $attributeNames;
    }

    public function setMainAttributesKey($mainAttributes)
    {
        return $this->mainAttributes = $mainAttributes;
    }

	public function getMainAttributesKey()
    {
        return $this->mainAttributes;
    }
    
	public function getMainAttributes()
    {
        return $filterAttributes = array_intersect_key($this->attributesToArray(), array_flip($this->getMainAttributesKey()));
    }

    public function getMainAttributesNames()
    {
        return $this->getAttributeNames($this->getMainAttributesKey());
    }

    public function getAllAttributeNames()
    {
        return $this->attributeNames;
    }

    public function getAttributeName($key)
    {
        return $this->attributeNames[$key];
    }

    public function getAttributeNames($attributes = array())
    {
        return $filterAttributes = array_intersect_key($this->attributeNames, array_flip($attributes));
    }

	public function getGlobalModel()
	{
		return GlobalModel::findOrFail($this->globalModel);
	}

	public function getIdAttribute()
	{
		return $this->getKey();
	}
}
